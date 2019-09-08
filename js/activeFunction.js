$(document).ready(() => {
    let lien = window.location.href;
    console.log(window.location.href);
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
    }
})