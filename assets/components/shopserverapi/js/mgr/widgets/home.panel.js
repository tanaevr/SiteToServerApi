shopServerApi.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'shopserverapi-panel-home',
		 stateEvents: ['tabchange'],
		 getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
		 */
		hideMode: 'offsets',
		items: [{
			html: '<h2>' + _('shopserverapi') + '</h2>',
			cls: '',
			style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: _('shopserverapi_items'),
				layout: 'anchor',
				items: [{
					html: _('shopserverapi_intro_msg'),
					cls: 'panel-desc',
				}, {
					xtype: 'shopserverapi-grid-items',
					cls: 'main-wrapper',
				}]
			}]
		}]
	});
	shopServerApi.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(shopServerApi.panel.Home, MODx.Panel);
Ext.reg('shopserverapi-panel-home', shopServerApi.panel.Home);
