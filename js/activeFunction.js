$(document).ready(() => {
    let lien = window.location.href;
    // console.log(window.location.href);
    if (lien.includes("acceuil")) {
        $("a.nav-link.active").removeClass("active");
        $("#home").addClass("active");
    } else
    if (lien.includes("listestartup")) {
        $("a.nav-link.active").removeClass("active");
        $("#liste").addClass("active");
    } else
    if (lien.includes("identification")) {
        $("a.nav-link.active").removeClass("active");
        $("#ident").addClass("active");
    } else
    if (lien.includes("formalisation")) {
        $("a.nav-link.active").removeClass("active");
        $("#formal").addClass("active");
    } else
    if (lien.includes("signin")) {
        $("a.nav-link.active").removeClass("active");
        $("#signin").addClass("active");
    } else
    if (lien.includes("signup")) {
        $("a.nav-link.active").removeClass("active");
        $("#signup").addClass("active");
    } else
    if (lien.includes("label")) {
        $("a.nav-link.active").removeClass("active");
        $("#labelisation").addClass("active");
    }
})