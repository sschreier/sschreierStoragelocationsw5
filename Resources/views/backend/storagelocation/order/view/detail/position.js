//{extends file="backend/order/view/detail/position.js"}
//{block name="backend/order/view/detail/position" append}
//{namespace name=backend/order/main}
Ext.define('Shopware.apps.Storagelocation.view.detail.Position', {
    /**
     * Defines an override applied to a class.
     * @string
     */
   override: 'Shopware.apps.Order.view.detail.Position',
 
   /**
     * Initializes the class override to provide additional functionality
     * like a new full page preview.
     *
     * @public
     * @return void
     */
   getColumns: function() {
        var me = this;

        var columns = me.callOverridden(arguments);

        var columnAttributeField = {
            header: '{s name=StoragelocationOrderPositionDetailColumnStoragelocation}Lagerort{/s}',
            dataIndex: 'attrStoragelocation',
			sortable: true,
            flex: 1
        };

        return Ext.Array.insert(columns, 3, [columnAttributeField]);
    }
 
});
//{/block}