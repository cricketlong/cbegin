KISSY.Editor.add("elementpaths",function(h){var d=KISSY.Editor,f=KISSY,i=f.Node,k=f.DOM;d.ElementPaths||function(){function e(a){this.cfg=a;this._cache=[];this._init()}k.addStyleSheet(".elementpath {   padding: 0 5px;    text-decoration: none;}.elementpath:hover {    background: #CCFFFF;    text-decoration: none;}","ke-ElementPaths");f.augment(e,{_init:function(){var a=this.cfg.editor;this.holder=new i("<span>");this.holder.appendTo(a.statusDiv);a.on("selectionChange",this._selectionChange,this);
d.Utils.sourceDisable(a,this)},disable:function(){this.holder.css("visibility","hidden")},enable:function(){this.holder.css("visibility","")},_selectionChange:function(a){var j=this.cfg.editor,l=this.holder;a=a.path.elements;var c,b;c=this._cache;for(b=0;b<c.length;b++){c[b].detach("click");c[b]._4e_remove()}this._cache=[];for(b=0;b<a.length;b++){c=a[b];var g=new i("<a href='#' class='elementpath'>"+(c.attr("_ke_real_element_type")||c._4e_name())+"</a>");this._cache.push(g);(function(m){g.on("click",
function(n){n.halt();j.focus();setTimeout(function(){j.getSelection().selectElement(m)},50)})})(c);l.prepend(g)}},destroy:function(){this.holder.remove()}});d.ElementPaths=e}();h.addPlugin("elementpaths",function(){var e=new d.ElementPaths({editor:h});this.destroy=function(){e.destroy()}})},{attach:false});
