## EE2 Mobile First - Stash Templates & SASS

The framework is very barebones. I use this to start my EE2 projects. 

*Note: Much of what's found here is probably highly-pointed to my needs, fell free to fork and customize away.*

#### Install Instructions
1. Move then [sync](http://expressionengine.com/user_guide/cp/design/templates/synchronize_templates.html) the templates. 
	* These files can be found at <code>/system/expressionengine/templates/default_site/</code>
	* You should also remove the 'x' at the beginning of any template files, these are to be [hidden templates](http://expressionengine.com/user_guide/templates/hidden_templates.html).

2. Move then install add-ons.
	* These files can be found at <code>/system/expressionengine/third_party/</code>
	* Once files are moved, in EE go to <code>Add-ons -> Modules</code> and install [Stash](http://devot-ee.com/add-ons/stash)

3. Move the <code>/assets/</code> folder.

***

<br />

## EE Add-ons Used

* [Stash](http://devot-ee.com/add-ons/stash)
* [Switchee](http://devot-ee.com/add-ons/switchee)
* [IfElse](http://devot-ee.com/add-ons/ifelse)
* [SetVersion](http://devot-ee.com/add-ons/setversion)

***

<br />

## EE Templates

I am using a template partial approach with [Stash](http://devot-ee.com/add-ons/stash). [EE Insider](http://eeinsider.com/articles/template-partials-using-stash/) and [Viget](http://viget.com/extend/ee-side-of-the-new-viget-part-1) both have great articles on this approach. I would highly recommend reading these articles if you haven't already seen them.

***

<br />

## SASS

I am using SASS to create a CSS barebones framework. There are several great features like: Breakpoints, Flexible Grids, Normailize.css, Font-size REM and PX fallback support, Etc....


