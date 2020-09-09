{assign var=_counter value=0}
{* {function name="menu" nodes=[] depth=0 parent=null}
    {if $nodes|count}
      <ul class="top-menu" {if $depth == 0}id="top-menu"{/if} data-depth="{$depth}">
        {foreach from=$nodes item=node}
            <li class="{$node.type}{if $node.current} current {/if}" id="{$node.page_identifier}">
            {assign var=_counter value=$_counter+1}
              <a
                class="{if $depth >= 0}dropdown-item{/if}{if $depth === 1} dropdown-submenu{/if}"
                href="{$node.url}" data-depth="{$depth}"
                {if $node.open_in_new_window} target="_blank" {/if}
              >
                {if $node.children|count}
                  {assign var=_expand_id value=10|mt_rand:100000}
                  <span class="float-xs-right hidden-md-up">
                    <span data-target="#top_sub_menu_{$_expand_id}" data-toggle="collapse" class="navbar-toggler collapse-icons">
                      <i class="material-icons add">&#xE313;</i>
                      <i class="material-icons remove">&#xE316;</i>
                    </span>
                  </span>
                {/if}
                {$node.label}
              </a>
              {if $node.children|count}
              <div {if $depth === 0} class="popover sub-menu js-sub-menu collapse"{else} class="collapse"{/if} id="top_sub_menu_{$_expand_id}">
                {menu nodes=$node.children depth=$node.depth parent=$node}
              </div>
              {/if}
            </li>
        {/foreach}
      </ul>
    {/if}
{/function} *}

{* <pre>
{$menu|@print_r} 
</pre> *}
{* <div class="menu js-top-menu position-static hidden-sm-down" id="_desktop_top_menu">
    {menu nodes=$menu.children}
    <div class="clearfix"></div>
</div> *}

{* TODO: Niestety obrazek przydzielony dla kategorii jest niedostępny plik ps_mainmenu.php 
czyli modul nie dokonca działa poprawnie i image_urls nie ładuje -- CHYBA! *}

{function name="menuchild" nodes=[] depth=0 parent=null}
    {if $nodes|count}
        <ul style="list-style-type:square">
            {foreach from=$nodes item=node}
            <li>
                <a href="{$node.url}">{$node.label}</a>
                {if $node.children|count}
                  {menuchild nodes=$node.children parent=$node}
                {/if}
              </li>
            {/foreach}
        </ul>
    {else}
        {$parent.label}
    {/if}
{/function}

{function name="menu" nodes=[] depth=0 parent=null}
    {if $nodes|count}
        {foreach from=$nodes item=node}
          {if $node.children|count}

          <li class="nav-item dropdown has-megamenu">
            <a class="nav-link dropdown-toggle" href="{$node.url}" data-toggle="dropdown"> {$node.label}  </a>
              <div class="dropdown-menu megamenu" role="menu">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="col-megamenu">
                                      <a href="{$node.url}"><h4 class="title">{$node.label}</h4></a>
                                      <ul class="list-unstyled">
                  {menuchild nodes=$node.children parent=$node}
                                </ul>
                              </div>  <!-- col-megamenu.// -->
                          </div><!-- end col-3 -->
                      </div><!-- end row --> 
                  </div> <!-- dropdown-mega-menu.// -->
            </li>
            {else}
                    		<li class="nav-item"><a class="nav-link" href="{$node.url}"> {$node.label} </a></li>

            {/if}

        {/foreach}

    {else}
	    <li class="nav-item"><a class="nav-link" href="#"> Services </a></li>
    {/if}
{/function}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="main_nav">
    <ul class="navbar-nav">
        {menu nodes=$menu.children}
    </ul>
  </div> <!-- navbar-collapse.// -->
</nav> 
{* 
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

  <a class="navbar-brand" href="#">Brand</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="main_nav">


<ul class="navbar-nav">

	<li class="nav-item active"> <a class="nav-link" href="#">Home </a> </li>
	<li class="nav-item"><a class="nav-link" href="#"> About </a></li>
	<li class="nav-item"><a class="nav-link" href="#"> Services </a></li>

	<li class="nav-item dropdown has-megamenu">
		<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Mega menu  </a>
	    <div class="dropdown-menu megamenu" role="menu">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="col-megamenu">
                            	<h6 class="title">Title Menu One</h6>
	                            <ul class="list-unstyled">
	                                <li><a href="#">Custom Menu</a></li>
	                                <li><a href="#">Custom Menu</a></li>
	                                <li><a href="#">Custom Menu</a></li>
	                                <li><a href="#">Custom Menu</a></li>
	                                <li><a href="#">Custom Menu</a></li>
	                                <li><a href="#">Custom Menu</a></li>
	                            </ul>
                            </div>  <!-- col-megamenu.// -->
                        </div><!-- end col-3 -->
                        <div class="col-md-3">
                        	<div class="col-megamenu">
                            <h6 class="title">Title Menu Two</h6>
                                <ul class="list-unstyled">
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                </ul>
                            </div>  <!-- col-megamenu.// -->
                        </div><!-- end col-3 -->
                        <div class="col-md-3">
                        	<div class="col-megamenu">
                            <h6 class="title">Title Menu Three</h6>
                                <ul class="list-unstyled">
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                </ul>
                            </div>  <!-- col-megamenu.// -->
                        </div>    
                        <div class="col-md-3">
                        	<div class="col-megamenu">
                            <h6 class="title">Title Menu Four</h6>
                                <ul class="list-unstyled">
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                    <li><a href="#">Custom Menu</a></li>
                                </ul>
                            </div>  <!-- col-megamenu.// -->
                        </div><!-- end col-3 -->
                    </div><!-- end row --> 
        </div> <!-- dropdown-mega-menu.// -->
	</li>
</ul>


<ul class="navbar-nav ml-auto">
    <li class="nav-item"><a class="nav-link" href="#"> Menu item </a></li>
    <li class="nav-item dropdown">
        <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown"> Dropdown </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="#"> Submenu item 1</a></li>
          <li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>
        </ul>
    </li>

</ul>

  </div> <!-- navbar-collapse.// -->

</nav> *}