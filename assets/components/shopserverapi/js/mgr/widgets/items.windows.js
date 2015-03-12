shopServerApi.window.CreateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'shopserverapi-item-window-create';
	}
	Ext.applyIf(config, {
		title: _('shopserverapi_item_create'),
		width: 550,
		autoHeight: true,
		url: shopServerApi.config.connector_url,
		action: 'mgr/item/create',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	shopServerApi.window.CreateItem.superclass.constructor.call(this, config);
};
Ext.extend(shopServerApi.window.CreateItem, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'textfield',
			fieldLabel: _('shopserverapi_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: false,
		}, {
			xtype: 'textarea',
			fieldLabel: _('shopserverapi_item_description'),
			name: 'description',
			id: config.id + '-description',
			height: 150,
			anchor: '99%'
		}, {
			xtype: 'xcheckbox',
			boxLabel: _('shopserverapi_item_active'),
			name: 'active',
			id: config.id + '-active',
			checked: true,
		}];
	}

});
Ext.reg('shopserverapi-item-window-create', shopServerApi.window.CreateItem);


shopServerApi.window.UpdateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'shopserverapi-item-window-update';
	}
	Ext.applyIf(config, {
		title: _('shopserverapi_item_update'),
		width: 550,
		autoHeight: true,
		url: shopServerApi.config.connector_url,
		action: 'mgr/item/update',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	shopServerApi.window.UpdateItem.superclass.constructor.call(this, config);
};
Ext.extend(shopServerApi.window.UpdateItem, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'hidden',
			name: 'id',
			id: config.id + '-id',
		}, {
			xtype: 'textfield',
			fieldLabel: _('shopserverapi_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: false,
		}, {
			xtype: 'textarea',
			fieldLabel: _('shopserverapi_item_description'),
			name: 'description',
			id: config.id + '-description',
			anchor: '99%',
			height: 150,
		}, {
			xtype: 'xcheckbox',
			boxLabel: _('shopserverapi_item_active'),
			name: 'active',
			id: config.id + '-active',
		}];
	}

});
Ext.reg('shopserverapi-item-window-update', shopServerApi.window.UpdateItem);
