var shopServerApi = function (config) {
	config = config || {};
	shopServerApi.superclass.constructor.call(this, config);
};
Ext.extend(shopServerApi, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('shopserverapi', shopServerApi);

shopServerApi = new shopServerApi();
