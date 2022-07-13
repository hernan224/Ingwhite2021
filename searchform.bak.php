<div class="searchform">
	<form action="/" method="get">
		<fieldset>
			<label for="search" class="sr-only">Buscar</label>
			<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Buscar..." />
			<input type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" />
		</fieldset>
	</form>
</div>