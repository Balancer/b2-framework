<!DOCTYPE html>
<html lang="ru">
<head>
	<title>{$this->browser_title()}</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
{if not empty($meta)}{foreach key=key item=value from=$meta}
	<meta name="{$key}" content="{$value|htmlspecialchars}" />
{/foreach}{/if}
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
{foreach item=css from=$css_list}
	<link rel="stylesheet" type="text/css" href="{$css}" />
{/foreach}
	<style>
		body {
			padding-top: 70px;
			padding-bottom: 30px;
		}

		.theme-dropdown .dropdown-menu {
			position: static;
			display: block;
			margin-bottom: 20px;
		}

		.theme-showcase > p > .btn {
			margin: 5px 0;
		}
{foreach from=$style item="s"}
{$s}
{/foreach}

	</style>

{foreach from=$js_include item="s"}
	<script type="text/javascript" src="{$s}"></script>
{/foreach}

{if not empty($javascript)}
	<script type="text/javascript"><!--
{foreach from=$javascript item="s"}
{$s}
{/foreach}
--></script>
{/if}

{if $bors_touch_params}
	<script type="text/javascript">$(function(){literal}{{/literal}$.getScript('/_bors/js/touch?{$bors_touch_params}'){literal}}{/literal});</script>
{/if}

{if not empty($header)}{foreach from=$header item="h"}
{$h}
{/foreach}{/if}

{foreach item=s from=$head_append}
{$s}
{/foreach}

</head>

<body role="document">

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
{*				<a class="navbar-brand" href="http://vault.balancer.ru/">Убежище</a> *}
			</div>
			<div class="collapse navbar-collapse">
{*
		 		<ul class="nav navbar-nav">
					<li><a href="http://vault.balancer.ru/chat/">Чат (без регистрации)</a></li>
					<li><a href="http://vault.balancer.ru/forum/">Форум убежища (запасной)</a></li>
					<li><a href="http://twitter.com/AirbaseRu/">Twitter @AirbaseRu</a></li>
					<li><a href="http://twitter.com/balancer73/">Twitter @Balancer73</a></li>
				</ul>
*}
			</div>{* /.nav-collapse *}
	 	 </div>
	</div>

	<div class="container theme-showcase" role="main">

		<div class="jumbotron">
			<div class="container">
				<h1>{$this->page_title()}</h1>
			</div>
		</div>

		<div class="container">
{$this->body()}
		</div>

	</div>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
<!--
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
-->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</body>

{foreach from=$js_include_post item="s"}
<script type="text/javascript" src="{$s}"></script>
{/foreach}
{if $javascript_post || $jquery_document_ready}
<script type="text/javascript"><!--
{foreach from=$javascript_post item="s"}
{$s}
{/foreach}
{if $jquery_document_ready}
$(document).ready(function(){literal}{{/literal}
{foreach from=$jquery_document_ready item="s"}
{$s}
{/foreach}
})
{/if}
--></script>
{/if}
</html>
