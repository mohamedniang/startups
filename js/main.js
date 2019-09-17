$(document).ready(() => {
    if (window.location.href.includes("signin")) {
        $("#signinError").toast({
            "delay": 3000
        })
        if (window.location.href.includes("er")) {
            console.log($("#signinError"));
            $("#signinError").toast("show")
            $("#signinError").on("hidden.bs.toast", () => {
                console.log("hidden");
                history.replaceState('', '', 'index.php?page=signin');
            })
        }
    }
    if (window.location.href.includes("signin.successfully")) {
        $("#addToast").toast({
            "delay": 3000
        })
        $("#addToast").toast("show")
        $("#addToast").on("hidden.bs.toast", () => {
            console.log("hidden");
            history.replaceState('', '', 'index.php?page=acceuil');
        })
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
    // active on the pagination
    if (window.location.href.includes("&p=")) {
        let p = window.location.href.split("&p=")[1]
        console.log(p)
            // let pLink = $("[href=\"index.php?page=listestartup&p=" + p + "\"]")
        let pLink = $("ul.pagination li.page-item a.page-link")
        console.log(typeof pLink);
        for (const page of pLink) {
            if (page.getAttribute("href").includes("&p=" + p)) {
                page.parentNode.className += " active";
                console.log(page.parentNode);
            }
        }
    }
})