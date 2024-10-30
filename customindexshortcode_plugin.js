(function() {
	tinymce.PluginManager.add('customindexshortcode_button', function( editor, url ) {
		editor.addButton( 'customindexshortcode_button', {
			title: 'Custom Index Shortcode',
			icon: 'customindexshortcode-icon',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Insert Custom Index Shortcode',
					style: 'height:90%;overflow-y:auto;width:50%;',
					body: [
						//TITLE
						{
							type: 'textbox',
							name: 'title',
							id: 'customindexshortcode-title',
							//size: 20,
							label: 'Title'
						},
						{
							type: 'label',
							name: 'title_label',
							id: 'title_label',
							style: 'height: 30px',
							multiline: true,
							onPostRender : function() {
								this.getEl().innerHTML =
								   "specify the title of the list. leave blank for no title.<br />"+
								   " "
							}
						},
						//TITLE SIZE
						{
							type: 'listbox',
							name: 'titlesize',
							id: 'customindexshortcode-titlesize',
							label: 'Title Size',
								'values': [
									{text: 'h1', value: 'h1'},
									{text: 'h2', value: 'h2'},
									{text: 'h3', value: 'h3'},
									{text: 'h4', value: 'h4'},
									{text: 'h5', value: 'h5'},
									{text: 'h6', value: 'h6'}
								]
						},
						{
							type: 'label',
							name: 'titlesize_label',
							id: 'titlesize_label',
							style: 'height: 30px',
							multiline: true,
							onPostRender : function() {
								this.getEl().innerHTML =
								   "specify the size of the title.<br />"+
								   " "
							}
						},
						//PARENT PAGE ID
						{
							type: 'textbox',
							name: 'id',
							id: 'customindexshortcode-id',
							//size: 20,
							label: 'Parent Page ID'
						},
						{
							type: 'label',
							name: 'id_label',
							id: 'id_label',
							style: 'height: 30px',
							multiline: true,
							onPostRender : function() {
								this.getEl().innerHTML =
								   "specify the parent page ID. leave blank to use the current page.<br />"+
								   " "
							}
						},
						//DEPTH
						{
							type: 'listbox',
							name: 'depth',
							id: 'customindexshortcode-depth',
							label: 'Depth',
								'values': [
									{text: '0', value: '0'},
									{text: '1', value: '1'},
									{text: '2', value: '2'},
									{text: '3', value: '3'}
								]
						},
						{
							type: 'label',
							name: 'depth_label',
							id: 'depth_label',
							style: 'height: 30px',
							multiline: true,
							onPostRender : function() {
								this.getEl().innerHTML =
								   "choose how many generations of children will be shown.<br />"+
								   " "
							}
						},
						//AUTHOR
						{
							type: 'listbox',
							name: 'author',
							id: 'customindexshortcode-author',
							label: 'Author',
								'values': [
									{text: 'no', value: 'no'},
									{text: 'yes with link', value: 'link'},
									{text: 'yes without link', value: 'nolink'}
								]
						},
						{
							type: 'label',
							name: 'author_label',
							id: 'author_label',
							style: 'height: 30px',
							multiline: true,
							onPostRender : function() {
								this.getEl().innerHTML =
								   "choose if you want the author link to be displayed and how.<br />"+
								   " "
							}
						},
						//ORDER BY
						{
							type: 'listbox',
							name: 'orderby',
							id: 'customindexshortcode-orderby',
							label: 'Order By',
								'values': [
									{text: 'page_title', value: 'post_title'},
									{text: 'menu_order', value: 'menu order'},
									{text: 'creation time', value: 'post_date'},
									{text: 'last modification time', value: 'post_modified'},
									{text: 'ID', value: 'ID'},
									{text: 'author', value: 'post_author'},
									{text: 'random', value: 'rand'}
								]
						},
						{
							type: 'label',
							name: 'orderby_label',
							id: 'orderby_label',
							style: 'height: 30px',
							multiline: true,
							onPostRender : function() {
								this.getEl().innerHTML =
								   "choose how you want the list to be sorted.<br />"+
								   " "
							}
						},
						//ORDER
						{
							type: 'listbox',
							name: 'order',
							id: 'customindexshortcode-order',
							label: 'Order By',
								'values': [
									{text: 'ASC', value: 'ASC'},
									{text: 'DESC', value: 'DESC'},
								]
						},
						{
							type: 'label',
							name: 'order_label',
							id: 'order_label',
							style: 'height: 30px',
							multiline: true,
							onPostRender : function() {
								this.getEl().innerHTML =
								   "choose the order.<br />"+
								   " "
							}
						},
						//LIST TYPE
						{
							type: 'listbox',
							name: 'list',
							id: 'customindexshortcode-list',
							label: 'List Type',
								'values': [
									{text: 'ordered', value: 'ordered'},
									{text: 'unordered', value: 'unordered'},
								]
						},
						{
							type: 'label',
							name: 'list_label',
							id: 'list_label',
							style: 'height: 30px',
							multiline: true,
							onPostRender : function() {
								this.getEl().innerHTML =
								   "choose the kind of list you want the elements to be shown in.<br />"+
								   " "
							}
						}
					],
					onsubmit: function( e ) {
						editor.insertContent( '[custom-index \
									title="' + e.data.title + '" \
									titlesize="' + e.data.titlesize + '" \
									id="' + e.data.id + '"\
									depth="' + e.data.depth + '"\
									author="' + e.data.author + '"\
									orderby="' + e.data.orderby + '"\
									order="' + e.data.order + '"\
									list="' + e.data.list + '"\
									]');
					}
				});
			}
						
		});
	});
})();