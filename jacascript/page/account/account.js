/* ViewModel */
var pageViewModel = null;
function PageViewModel(nowPage) {
    this.nowPage = ko.observable(nowPage);
}

/* Dashboard */
$(function() {
    pageViewModel = new PageViewModel("帳號管理%>使用者");
    ko.applyBindings(getMainViewModel());
    //ko.applyBindings(pageViewModel, document.getElementById("_subPage"));
});