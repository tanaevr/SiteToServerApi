shopServerApi.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'shopserverapi-panel-home', renderTo: 'shopserverapi-panel-home-div'
		}]
	});
	shopServerApi.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(shopServerApi.page.Home, MODx.Component);
Ext.reg('shopserverapi-page-home', shopServerApi.page.Home);
