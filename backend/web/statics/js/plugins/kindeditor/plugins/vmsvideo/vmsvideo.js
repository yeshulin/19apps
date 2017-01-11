/*******************************************************************************
 * KindEditor - WYSIWYG HTML Editor for Internet
 * Copyright (C) 2006-2011 kindsoft.net
 *
 * @author Roddy <luolonghao@gmail.com>
 * @site http://www.kindsoft.net/
 * @licence http://www.kindsoft.net/license.php
 *******************************************************************************/

KindEditor.plugin('vmsvideo', function(K) {
	var self = this, name = 'vmsvideo',
			fileManagerJson = K.undef(self.fileManagerJson, self.basePath + 'php/file_manager_json.php'),
			imgPath = self.pluginsPath + name + '/images/',
			lang = self.lang(name + '.');
	self.clickToolbar(name, function() {
		var html = '<div style="padding:10px 20px;">' +
				'<div class="ke-plugin-filemanager-body" id="vms-video">' +
				'<div class="ke-header" style="height: 60px;line-height: 60px;padding-left: 10px;">' +
				'<div class="ke-left">视频名称:  ' +
				'<input id="kindeditor_plugin_map_address" name="address" class="ke-input-text" value="" style="width:200px;"> ' +
				'<span class="ke-button-common ke-button-outer">' +
				'<input type="button" name="searchBtn" class="ke-button-common ke-button" value="搜索">' +
				'</span>' +
				'</div></div>' +
				'</div></div>';



		var dialog = self.createDialog({
			name : name,
			width : 610,
			title : self.lang(name),
			body : html,
			yesBtn : {
				name : '确认',
				click : function(e) {
					var VmsVideo = vmsVideoId[0].childNodes,vmsid = 0, img;
					for (var i = 1; i < VmsVideo.length; i++ ) {
						var _Item = K(VmsVideo[i]);
						if (_Item.hasClass("vms-ok")) {
							img = _Item[0].childNodes[0].childNodes[0].src;
							vmsid = _Item.attr("vmsid");
						}
					}
					if (vmsid != 0) {
						var param = 'dir=getVms&type=video&vmsid='+vmsid;
						K.ajax(K.addParam(fileManagerJson, param + '&' + new Date().getTime()), function(data) {
							self.insertHtml('<div class="vms-video" style="min-width:500px;min-height:250px;text-align:center;background:url(' + img + ') no-repeat">' + data.play + '</div>');
						})
					}
					self.hideDialog();
					if (self._IE && self.cmd) {
						self.cmd.select();
					}
					return false;
				}
			}
			//beforeRemove : function() {
			//	iframe.remove();
			//}
		});

		function bindEvent(el) {
			el.click(function(e) {
				var _KThis = K(this), VmsVideo = vmsVideoId[0].childNodes;
				for (var i = 1; i < VmsVideo.length; i++ ) {
					var _Item = K(VmsVideo[i]);
					if (_Item.hasClass("vms-ok")) {
						_Item.removeClass("vms-ok");
						var _VmsOk = _Item[0].childNodes[2];
						_VmsOk.parentNode.removeChild(_VmsOk);
					}
				}
				_KThis.addClass("vms-ok");
				_KThis.append(K('<i class="vmsOk"></i>'));
			});
		}

		function reloadPage() {
			var param = 'dir=vmsVideo';
			dialog.showLoading(self.lang('ajaxLoading'));
			K.ajax(K.addParam(fileManagerJson, param + '&' + new Date().getTime()), function(data) {
				dialog.hideLoading();
				if (data != null && data instanceof Array)
				{
					for (x in data)
					{
						item = K('<div vmsid="'+data[x].vmsid+'" class="ke-inline-block ke-item"></div>');
						item.css('position', 'relative');
						var photoDiv = K('<div class="ke-inline-block ke-photo"></div>');
						photoDiv.css('cursor', 'pointer');
						var img = K('<img src="' + data[x].thumb + '" width="80" height="80" alt="' + data[x].videoname + '" />');
						photoDiv.append(img);
						item.append(photoDiv);
						item.append('<div class="ke-name" title="' + data[x].videoname + '">' + data[x].videoname + '</div>');
						vmsVideoId.append(item);
						bindEvent(item);
					}
				}
			});
		}
		reloadPage();

		var div = dialog.div,
				vmsVideoId = K('#vms-video', div),
				item;

	});
});
