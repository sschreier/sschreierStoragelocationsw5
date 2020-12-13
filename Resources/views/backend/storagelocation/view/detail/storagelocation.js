Ext.define('Shopware.apps.Storagelocation.view.detail.Storagelocation', {
	extend: 'Shopware.model.Container',
    padding: 25,
	title: '{s name=StoragelocationDetailTitle}Lagerort{/s}',
    configure: function () {
        return {
			searchController: 'Storagelocation',
            fieldSets: [
                {
					title: '{s name=StoragelocationDetailFieldsetTitle}Lagerort{/s}',
                    fields: {
						label: { fieldLabel: '{s name=StoragelocationDetailLabel}Lagerort{/s}'}
                    }
                }
            ]
        }
	}
});