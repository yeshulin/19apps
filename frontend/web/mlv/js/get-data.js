
function getData(){
	var objThis = this;
	var preSrc = urlPre;
	getData.prototype.getGoodsList = function(method,pagesize,page,callback,where){
		var _where = '';
		//console.log(where);
		if (where != undefined)
		{
			_where = where.join("&");
		}

		var _url1 = "api/goods/"+method+"?";
		var _data = ["pagesize="+pagesize,"page="+page];
		var _url2 = _data.join("&");
		if (_where != '') {
			_url2 = _url2 + '&'+_where;
		}
		var _url = preSrc + _url1 + _url2;
		//console.log(_url);
		$.get(_url,function(result){
			callback(result);
		});
	};

	getData.prototype.getMycause = function(pagesize,page,callback){
		var _url1 = "api/course?";
		var _data = ["pagesize="+pagesize,"page="+page];
		var _url2 = _data.join("&");
		var _url = preSrc + _url1 + _url2;
		$.get(_url,function(result){
			callback(result);
		});
	};

	getData.prototype.getCoursePlay = function(id,callback){
		var _url = preSrc+"api/course/play/"+id;
		$.get(_url,function(result){
			callback(result);
		});
	};

	getData.prototype.getMyCollect = function(method,pagesize,page,callback){
		var _url1 = "api/collect/"+method+"?";
		var _data = ["pagesize="+pagesize,"page="+page];
		var _url2 = _data.join("&");
		var _url = preSrc + _url1 + _url2;
		$.post(_url,function(result){
			callback(result);
		});
	};

	 getData.prototype.getMyorder = function(pagesize,page,callback){
		var _url1 = "api/order/list?";
		var _data = ["pagesize="+pagesize,"page="+page];
		var _url2 = _data.join("&");
		var _url = preSrc + _url1 + _url2;
		$.post(_url,function(result){
			callback(result);
		});
	};
	getData.prototype.getOrderview = function(trade_sn,callback){
		var _url1 = "api/order/view?";
		var _data = ["trade_sn="+trade_sn];
		var _url2 = _data.join("&");
		var _url = preSrc + _url1 + _url2;
		$.post(_url,function(result){
			callback(result);
		});
	};
	getData.prototype.getMyAddressList = function(callback){
		var _url1 = "api/address/list";
		var _url = preSrc + _url1;
		$.post(_url,function(result){
			callback(result);
		});
	};
	getData.prototype.getMyAddressView = function(id,callback){
		var _url1 = "api/address/view";
		var _url = preSrc + _url1;
		var _data = {
			"id":id
		}
		$.post(_url,_data,function(result){
			callback(result);
		});
	};
	getData.prototype.getMyfeedbackList = function(callback){
		var _url1 = "api/feedback/list";
		var _url = preSrc + _url1;
		$.post(_url,function(result){
			callback(result);
		});
	};
	getData.prototype.getMyfeedbackView = function(id,callback){
		var _url1 = "api/feedback/view";
		var _url = preSrc + _url1;
		var _data = {
			"id":id
		}
		$.post(_url,_data,function(result){
			//console.log(result);
			callback(result);
		});
	};
	getData.prototype.getMymessageList = function(callback){
		var _url1 = "api/message/list";
		var _url = preSrc + _url1;
		$.post(_url,function(result){
			callback(result);
		});
	};
	getData.prototype.getMymessageView = function(id,callback){
		var _url1 = "api/message/view";
		var _url = preSrc + _url1;
		var _data = {
			"id":id
		}
		$.post(_url,_data,function(result){
			callback(result);
		});
	};
	getData.prototype.getActivationList = function(pagesize,page,callback){
		var _url1 = "api/activation/logs?";
		var _data = ["pagesize="+pagesize,"page="+page];
		var _url2 = _data.join("&");
		var _url = preSrc + _url1 + _url2;
		$.get(_url,function(result){
			callback(result);
		});
	};
	getData.prototype.getLabList = function(callback){
		var _url1 = "api/use-lab/list";
		var _url = preSrc + _url1;
		var _data = {};
		$.post(_url,_data,function(result){
			callback(result);
		});
	};
	getData.prototype.getPracticalList = function(callback){
		var _url1 = "api/use-practical/list";
		var _url = preSrc + _url1;
		var _data = {};
		$.post(_url,_data,function(result){
			callback(result);
		});
	};
	getData.prototype.getMyLiveList = function(callback){
		var _url1 = "api/live/mylive";
		var _url = preSrc + _url1;
		var _data = {};
		$.post(_url,_data,function(result){
			callback(result);
		});
	};
	getData.prototype.getMyLiveView = function(id,callback){
		var _url1 = "api/live/myview";
		var _url = preSrc + _url1;
		var _data = {
			"live_id":id
		};
		console.log(_url);
		console.log(_data);
		$.post(_url,_data,function(result){
			callback(result);
		});
	};
	getData.prototype.getContactus = function(callback){
		var _url1 = "api/about/contactus";
		var _url = preSrc + _url1;
		$.post(_url,function(result){
			callback(result);
		});
	};

}
	
