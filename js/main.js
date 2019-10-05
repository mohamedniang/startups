$(document).ready(() => {
    // how to enable tooltips/popover everywhere :
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $(function() {
            $('[data-toggle="popover"]').popover({
                container: 'body'
            })
        })
        // end of how to enable tooltips everywhere
    if (window.location.href.includes("signin")) {
        $("#signinError").toast({
            "delay": 3000
        })
        if (window.location.href.includes("er")) {
            $("#signinError").toast("show")
            $("#signinError").on("hidden.bs.toast", () => {
                history.replaceState('', '', 'index.php?page=signin');
            })
        }
    }
    if (window.location.href.includes("detail")) {
        $('#img-file').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            var actualFileName = fileName.split('path\\')[1]
                //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(actualFileName);
        })
        $("#img-file").on("hover", () => {
            $(this).popover("toggle")
        })
    }
    if (window.location.href.includes("&sc=")) {
        $("#addToast").toast({
            "delay": 3000
        })
        $("#addToast").toast("show")
        $("#addToast").on("hidden.bs.toast", () => {
            history.replaceState('', '', 'index.php?page=acceuil');
        })
    }
    // for the "hover" on dropdown
    if (window.location.href.includes("listestartup")) {
        $('#secteurDropdown').parent().hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn(200);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut(200);
        });
    }
    let widH = $(window).height();
    let pagH = $(".page").height();
    let fotH = $("footer").height();
    let hedH = $("header").height();

    if (pagH + fotH < widH) {
        $(".page").css("min-height", widH - fotH - hedH);
    }

    if (window.location.href.includes("acceuil")) {
        $(".redir .inscr").click(() => {
            window.location = "index.php?page=signup";
            return false;
        })
        $(".redir .conx").click(() => {
            window.location = "index.php?page=signin";
            return false;
        })
    }
    // active on the pagination
    if (window.location.href.includes("&p=")) {
        let p = window.location.href.split("&p=")[1]
            // let pLink = $("[href=\"index.php?page=listestartup&p=" + p + "\"]")
        let pLink = $("ul.pagination li.page-item a.page-link")
        for (const page of pLink) {
            if (page.getAttribute("href").includes("&p=" + p)) {
                page.parentNode.className += " active";
            }
        }
    }
})