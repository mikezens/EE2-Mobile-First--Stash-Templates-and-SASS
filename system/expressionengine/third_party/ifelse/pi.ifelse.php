<?php

$plugin_info = array(
  'pi_name' => 'IfElse',
  'pi_version' =>'1.2.1',
  'pi_author' =>'Mark Croxton',
  'pi_author_url' => 'http://www.hallmark-design.co.uk/',
  'pi_description' => 'Early parsing of if/else advanced conditionals (EE 1.x)',
  'pi_usage' => Ifelse::usage()
  );

class Ifelse {
	
	public $return_data = '';
	private $_ph = array();
	
	/** 
	 * Constructor
	 *
	 * Parses advanced conditionals in template tagdata
	 *
	 * @access public
	 * @return void
	 */
	public function Ifelse() 
	{
		global $TMPL, $FNS, $SESS;
		
		$tagdata = $TMPL->tagdata;
		
		// replace content inside nested tags with indexed placeholders, storing it in an array for later
		// be careful to match *outer* tags only
		$pattern = '/{exp:(?>(?!{?exp:).|(?R))*{&#47;exp:/si';
		$tagdata = preg_replace_callback($pattern, array(get_class($this), '_placeholders'), $tagdata);

		// parse advanced conditionals
		$tagdata = $TMPL->advanced_conditionals($tagdata);
		
		// cleanup - remove leftover {/if}. Appears to be a bug in template parser?
		$tagdata = str_replace('{&#47;if}', '', $tagdata);
		
		// restore original content inside nested tags, using str_replace for speed
		foreach ($this->_ph as $index => $val)
		{
			$tagdata = str_replace('[_'.__CLASS__.'_'.($index+1).']', $val, $tagdata);
		}

		// restore no_results conditionals
		$tagdata = str_replace('{no_results}', '{if no_results}', $tagdata);
		$tagdata = str_replace('{&#47;no_results}', '{&#47;if}', $tagdata);
		
		// return
		$this->return_data = $tagdata;
	}
	
	/** 
	 * _placeholders
	 *
	 * Replaces nested tag content with placeholders
	 *
	 * @access private
	 * @return string
	 */
	private function _placeholders($matches)
	{
		$this->_ph[] = $matches[0];
		return '[_'.__CLASS__.'_'.count($this->_ph).']';
	}

	// usage instructions
	public function usage() 
	{
  		ob_start();
?>
-------------------
HOW TO USE
-------------------

{exp:ifelse parse="inward"}	
	{if member_id == '1' OR group_id == '2'}
		Admin content
	{if:elseif logged_in}
		Member content
	{if:else}
		Public content
	{/if}
{/exp:ifelse}

To preserve {if no results} conditionals inside nested tags, wrap your 'no results' content with {no_results}{/no_results}. Example:

{exp:ifelse parse="inward"}	
	{if segment_1 == 'news' AND segment_2 == 'category'}
		News category page
		{exp:channel:entries channel="news"}
			{no_results} 
				No results 
			{/no_results}
		{/exp:channel:entries}
	{if:elseif segment_1 == 'news' AND segment_2 == ''}
	 	News landing page
	{if:else}
		News story page
	{/if}
{/exp:ifelse}

Some notes about nesting:
This plugin will not parse advanced conditionals *inside* any nested plugin/module tags; these will be left untouched for the parent tag to process.

This plugin cannot currently be nested inside itself due to a flaw in the way the EE template parser works. However, the if/else conditional tags themselves can be nested.

	<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}	
}

/* End of file pi.ifelse.php */ 
/* Location: ./system/plugins/pi.ifelse.php */