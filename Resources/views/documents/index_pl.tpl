{extends file="documents/index.tpl"}

{block name="document_index_table_head_tax"}{/block}

{block name="document_index_table_head_price"}{/block}

{block name="document_index_table_tax"}{/block}

{block name="document_index_table_price"}{/block}

{block name="document_index_amount"}{/block}

{block name="document_index_table_head_quantity"}
	{$smarty.block.parent}
	{block name="document_index_table_head_quantity_storage_location"}
		<td align="right" width="5%" class="head">
			<strong>{s name="DocumentIndexPlHeadStorageLocation"}Lagerort{/s}</strong>
		</td>
	{/block}
{/block}

{block name="document_index_table_quantity"}
	{$smarty.block.parent}
	{block name="document_index_table_quantity_storage_location"}
		<td align="right" width="5%" valign="top">
			{$storagelocations.$number.attr_storagelocation}
		</td>
	{/block}	
{/block}

{block name="document_index_head_bottom"}
	<h1>{s name="DocumentIndexPlPickinglistNumber"}Laufzettel Nr.{/s} {$Document.id}</h1>
	{s name="DocumentIndexPlPageCounter"}Seite {$page+1} von {$Pages|@count}{/s}
{/block}

{block name="document_index_table_each"}{if $position.modus == 0 || $position.modus == 1}{$smarty.block.parent}{/if}{/block}

{block name="document_index_head_right"}
	{$smarty.block.parent}
	{if $Document.bid}{s name="DocumentIndexPlInvoiceID"}Zur Rechnung:{/s} {$Document.bid}<br />{/if}
{/block}