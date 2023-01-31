////////////////////////////////////////////
// load
////////////////////////////////////////////
// load SideNav
// fetch("./sideNav.html")
//     .then((response) => response.text())
//     .then((html) => {
//         document.getElementById("sidenav-main").innerHTML = html;
//     });
// // load navBar
// fetch("./navBar.html")
//     .then((response) => response.text())
//     .then((html) => {
//         document.getElementById("navbarBlur").innerHTML = html;
//     })
// load footer
fetch("./footer.html")
    .then((response) => response.text())
    .then((html) => {
        document.getElementById("loadFooter").innerHTML = html;
    })
////////////////////////////////////////////
// add and sub 
////////////////////////////////////////////
$('.add').click(function () {
    $(this).prev().val(+$(this).prev().val() + 1);
});
$('.sub').click(function () {
    if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
});