
function renderData(){
	var objThis = this;
	renderData.prototype.importModel = function (modelList,modelName,callback){
		
			if(!$("script.render-model[tag='"+ modelName +"']")[0]){
				var _model = $(document.createElement("script"));
				var _src = urlPre + "/mlv/js/model/" + modelList +".html";
				_model.attr("tag",modelName);
				_model.attr("id",modelName);
				// _model.attr("src",_src);
				_model.attr("type","text/x-jsrender");
				_model.addClass("render-model");				
				// $.get(_src,function(data){
				// 	console.log(data);
				// });
				$.ajax({
					async:true,
					url:_src,
					dataType : "html",
					success:function(result){
						_model.html($(result).find("#" + modelName).html());
						$("head").append(_model[0]);	
						callback();					
					},
					error:function(result){
						// console.log(2);
						// console.log(result);
					}
				});
			
			}else{
				callback();	
			}			
	
	}	
	renderData.prototype.renderPageModel = function(pageObj, callback){
		objThis.importModel("model_list","page_model",function(){
			var defaults = {
				totalData:0,			//数据总条数
				showData:9,				//每页显示的条数
				pageCount:9,			//总页数,默认为9
				current:1,				//当前第几页
				prevCls:'prev',			//上一页class
				nextCls:'next',			//下一页class
				prevContent:'上一页',		//上一页内容
				nextContent:'下一页',		//下一页内容
				activeCls:'current',		//当前页选中状态
				coping:true,			//首页和尾页
				homePage:'首页',			//首页节点内容
				endPage:'尾页',				//尾页节点内容
				count:2,				//当前页前后分页个数
				jump:false,				//跳转到指定页数
				jumpIptCls:'jump-ipt',	//文本框内容
				jumpBtnCls:'jump-btn',	//跳转按钮
				jumpBtn:'跳转',			//跳转按钮文本
				callback:function(){}	//回调
			};

			var Pagination = function(element,options){
				//全局变量
				var opts = options,//配置
						current,//当前页
						$document = $(document),
						$obj = $(element);//容器

				/**
				 * 设置总页数
				 * @param int page 页码
				 * @return opts.pageCount 总页数配置
				 */
				this.setTotalPage = function(page){
					return opts.pageCount = page;
				};

				/**
				 * 获取总页数
				 * @return int p 总页数
				 */
				this.getTotalPage = function(){
					var p = opts.totalData || opts.showData ? Math.ceil(parseInt(opts.totalData) / opts.showData) : opts.pageCount;
					return p;
				};

				//获取当前页
				this.getCurrent = function(){
					return current;
				};

				/**
				 * 填充数据
				 * @param int index 页码
				 */
				this.filling = function(index){
					var html = $('<ul></ul>');
					html.addClass("cd-pagination no-space");
					current = index || opts.current;//当前页码
					var pageCount = this.getTotalPage();

					if(current > 1){//上一页
						html.append('<li><a href="javascript:;" class="'+opts.prevCls+'">'+opts.prevContent+'</a></li>');
					}else{
						$obj.find('.'+opts.prevCls) && $obj.find('.'+opts.prevCls).remove();
					}
					if(current >= opts.count * 2 && current != 1 && pageCount != opts.count){
						var home = opts.coping && opts.homePage ? opts.homePage : '1';
						if (opts.coping)
						{
							html.append('<li><a href="javascript:;" data-page="1">'+home+'</a></li><li><span>...</span></li>');
						};
					}

					var start = current - opts.count,
							end = current + opts.count;
					((start > 1 && current < opts.count) || current == 1) && end++;
					(current > pageCount - opts.count && current >= pageCount) && start++;
					for (;start <= end; start++) {
						if(start <= pageCount && start >= 1){
							if(start != current){
								html.append('<li><a href="javascript:;" data-page="'+start+'">'+ start +'</a></li>');

							}else{
								html.append('<li><span class="'+opts.activeCls+'">'+ start +'</span></li>');
							}
						}
					}
					if(current + opts.count < pageCount && current >= 1 && pageCount > opts.count){
						var end = opts.coping && opts.endPage ? opts.endPage : pageCount;
						if (opts.coping)
						{
							html.append('<li><span>...</span></li><li><a href="javascript:;" data-page="'+pageCount+'">'+end+'</a></li>');
						}

					}
					if(current < pageCount){//下一页
						html.append('<li><a href="javascript:;" class="'+opts.nextCls+'">'+opts.nextContent+'</a></li>');

					}else{
						$obj.find('.'+opts.nextCls) && $obj.find('.'+opts.nextCls).remove();
					}
					if (opts.jump)
					{
						html.append('<li><input type="text" class="'+opts.jumpIptCls+'"><a href="javascript:;" class="'+opts.jumpBtnCls+'">'+opts.jumpBtn+'</a></li>');
					}

					$obj.html(html);
				};

				//绑定事件
				this.eventBind = function(){
					var self = this;
					var pageCount = this.getTotalPage();//总页数
					$obj.off().on('click','a',function(){
						if($(this).hasClass(opts.nextCls)){
							var index = parseInt($obj.find('.'+opts.activeCls).text()) + 1;
						}else if($(this).hasClass(opts.prevCls)){
							var index = parseInt($obj.find('.'+opts.activeCls).text()) - 1;
						}else if($(this).hasClass(opts.jumpBtnCls)){
							if($obj.find('.'+opts.jumpIptCls).val() !== ''){
								var index = parseInt($obj.find('.'+opts.jumpIptCls).val());
							}else{
								return;
							}
						}else{
							var index = parseInt($(this).data('page'));
						}
						self.filling(index);
						typeof opts.callback === 'function' && opts.callback(self);
					});
					//输入跳转的页码
					$obj.on('input propertychange','.'+opts.jumpIptCls,function(){
						var $this = $(this);
						var val = $this.val();
						var reg = /[^\d]/g;
						if (reg.test(val)) {
							$this.val(val.replace(reg, ''));
						}
						(parseInt(val) > pageCount) && $this.val(pageCount);
						if(parseInt(val) === 0){//最小值为1
							$this.val(1);
						}
					});
					//回车跳转指定页码
					$document.keydown(function(e){
						var self = this;
						if(e.keyCode == 13 && $obj.find('.'+opts.jumpIptCls).val()){
							var index = parseInt($obj.find('.'+opts.jumpIptCls).val());
							self.filling(index);
							typeof opts.callback === 'function' && opts.callback(self);
						}
					});
				};

				//初始化
				this.init = function(){
					$obj.empty();
					if (opts.showData > opts.totalData) return false;
					this.filling(opts.current);
					this.eventBind();
				};
				this.init();
			};
			if(typeof pageObj == 'function'){//重载
				callback = pageObj;
				pageObj = {};
			}else{
				pageObj = pageObj || {};
				if (typeof  callback != 'function')
				{
					callback =  function(){
						console.log(345345);
					};
				}
			}
			//console.log(callback);
			var j, _options = [],_isCallback = true;
			//for (j in pageObj) {
			_options['totalData'] = pageObj.total;
			_options['showData'] = pageObj.pageSize;
			_options['current'] = pageObj.currentPage;
			if (typeof pageObj.callback == 'function')
			{
				_options['callback'] = pageObj.callback;
			} else {
				var _callback = "function(index){" +
						pageObj.page_btFn+"(" +
						pageObj.pageSize + "," +
						"index.getCurrent()," +
						"$('"+ pageObj.dataTarget.selector +"')," +
						"{page_target : '"+ pageObj.page_target +"',page_btFn : '"+ pageObj.page_btFn +"'})" +
						"}";
				_options['callback'] = (new Function("return "+_callback))();
			}
			//console.log(_options);

			//}

			var options = $.extend({},defaults,_options);
			var pagination = new Pagination($(pageObj.page_target), options);
			callback(pagination);




return false;










			var page_template = $.templates("#page_model");
			var _currentPage = pageObj.currentPage;
			var _pageSize = pageObj.pageSize;
			var _total = pageObj.total;
			var _totalPage = Math.ceil(parseInt(_total)/parseInt(_pageSize));
			$(pageObj.page_target).html('');
			console.log(_total <= 0 || _total <= _pageSize);
			if (_total <= 0 || _total <= _pageSize) {
				return false;
			}





			//console

			if (typeof(pageObj.callfunc) == 'function')
			{
				console.log(345435);
			}
			
			var _btFnF = pageObj.page_btFn+"(" + pageObj.pageSize + ",1,$('"+ pageObj.dataTarget.selector +"'),{page_target : '"+ pageObj.page_target +"',page_btFn : '"+ pageObj.page_btFn +"'})";
			var _btFnP = pageObj.page_btFn+"(" + pageObj.pageSize + ","+ (pageObj.currentPage - 1) +",$('"+ pageObj.dataTarget.selector +"'),{page_target : '"+ pageObj.page_target +"',page_btFn : '"+ pageObj.page_btFn +"'})";
			var _btFnB = pageObj.page_btFn+"(" + pageObj.pageSize + "," + (pageObj.currentPage + 1) + ",$('"+ pageObj.dataTarget.selector +"'),{page_target : '"+ pageObj.page_target +"',page_btFn : '"+ pageObj.page_btFn +"'})";
			var _btFnEnd = pageObj.page_btFn+"(" + pageObj.pageSize + "," + _totalPage + ",$('"+ pageObj.dataTarget.selector +"'),{page_target : '"+ pageObj.page_target +"',page_btFn : '"+ pageObj.page_btFn +"'})";
			var _urlList =[{fn:""},{fn:""},{fn:""},{fn:""}];
			var _hasEnd = "";
					var objThis = $(this);
					var _btFn = "";
					_urlList = _urlList.map(function(n,i){	
						i++;
						var currentPage = _currentPage;
						var pageSize = _pageSize;
						var total = _total;
						var totalPage = _totalPage;
//						console.log(i);
//						console.log(_current%4-i);
						if(currentPage%4 != 0){
							var rtNum = currentPage-(currentPage%4-i);	
						}else{
							var rtNum = currentPage-(currentPage%4+4-i);	
						}
						

						//console.log(totalPage);
						if(rtNum>totalPage){
							//console.log(rtNum);							
							_btFn = null;	
							_hasEnd = false;
						}else{
							_btFn = pageObj.page_btFn+"(" + pageSize + "," + rtNum + ",$('"+ pageObj.dataTarget.selector +"'),{page_target : '"+ pageObj.page_target +"',page_btFn : '"+ pageObj.page_btFn +"'})";
							_hasEnd = true;
						}
						
						if(rtNum==currentPage){
							n.current = true;
						}else{
							n.current = false;
						}
						
						n.fn = _btFn;
						n.num = rtNum;
						return n;
						
					});
				
			u_data = [$.extend(pageObj,{
				pageFn : _urlList,
				btFnF : _btFnF,
				btFnP : _btFnP,
				btFnB :_btFnB,
				btFnEnd :_btFnEnd,
				Endnum :_totalPage,
				hasEnd : _hasEnd
			})];
			//console.log(pageObj);
			//console.log(u_data);
			var page_htmlOutput = page_template.render(u_data);
			// console.log(_totalPage);
			if(_totalPage>1){
				$(pageObj.page_target).html(page_htmlOutput);
			}

				
					
		});
	};
	//target容器 ， data数据 
	renderData.prototype.renderCause = function(target,data,pageObj,callback){			
		//引入模板
		objThis.importModel("model_list","cause_list",function(){
			var template = $.templates("#cause_list");
			// console.log(data);
			var u_data = $.map(data.data,function(n){
				//课程数据
				if (!(n.course == null)) {
					n = {
					img : n.course.thumb?n.course.thumb:urlPre+"/mlv/img/temp/asd8972143912.png",
					title : n.course.course_name?n.course.course_name:"课程名待定",
					doneSum : n.course.doneSum?n.course.doneSum:"0",
					type: '1',
	//				countDown : n.course.countDown?n.course.countDown:"017-06-06  00:00:00",
	//				compuSum : n.course.compuSum?n.course.compuSum:"0"
					}
					//收藏数据
				}else if(!(n.items == null)){
					n = {
					img : n.items.thumb?n.items.thumb:urlPre+"/mlv/img/temp/asd8972143912.png",
					title : n.items.course_name?n.items.course_name:"课程名待定",
					doneSum : n.items.doneSum?n.items.doneSum:"0",
					type: '1',
	//				countDown : n.course.countDown?n.course.countDown:"017-06-06  00:00:00",
	//				compuSum : n.course.compuSum?n.course.compuSum:"0"
					}
				}else{
					n = {};
				}
				return n;

			});
			var htmlOutput = template.render(u_data);		
			target.html(htmlOutput);
			//添加翻页			
			if(pageObj){
				var _pageObj = $.extend(pageObj,{
					currentPage:data.data.currentPage,
					pageSize:data.data.pageSize,
					total:data.data.total,
					dataTarget : target
				});
				objThis.renderPageModel(_pageObj);	
			}
			

		});

		
	};

	renderData.prototype.renderOrder = function(target,data,callback){			
		//引入模板
		objThis.importModel("order_list","cause_list",function(){
			var template = $.templates("#cause_list");
			var htmlOutput = template.render(data);		
			target.html(htmlOutput);
		});

		
	};

	renderData.prototype.renderOrderview = function(target,data,callback){			
		//引入模板
		objThis.importModel("order_view","cause_list",function(){
			var template = $.templates("#cause_list");
			var htmlOutput = template.render(data);		
			target.html(htmlOutput);
		});

		
	};


	//renderData.prototype.renderCause = function(target,data,callback){
	//	//引入模板
	//	objThis.importModel("model_list","cause_list2",function(){
	//		var template = $.templates("#cause_list");
	//		var htmlOutput = template.render(data);
	//		target.html(htmlOutput);
	//	});
	//
	//
	//};
}