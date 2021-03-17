{extends file='parent:frontend/index/index.tpl'}
{* Shop header *}

{block name='frontend_index_navigation'}
{if $JkTheme.fixNavigation}
<div id="jk-navigation" class="jk-fixed">
  {/if}
  {$smarty.block.parent}
  {if $JkTheme.fixNavigation}
</div>
{/if}
{/block}
