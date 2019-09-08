$(document).ready(() => {
    if (window.location.href.includes("signin.successfully")) {
        $("#inscrConf").modal("show")
    }
    let widH = $(window).height();
    let pagH = $(".page").height();
    let fotH = $("footer").height();
    let hedH = $("header").height();
    console.log(widH + "-" + pagH + "-" + fotH);
    console.log("\n sum = " + (pagH + fotH));

    if (pagH + fotH < widH) {
        console.log("\n min = " + (widH - fotH));
        console.log("minH = " + $(".page").css("min-height"));
        $(".page").css("min-height", widH - fotH - hedH);
        console.log("height" + $(".page").css("min-height"));
    }

    if (window.location.href.includes("acceuil")) {
        $(".redir .inscr").click(() => {
            console.log($(this));
            window.location = "index.php?page=signup";
            return false;
        })
        $(".redir .conx").click(() => {
            console.log($(this));
            window.location = "index.php?page=signin";
            return false;
        })
    }
})