$(function() {
    "use strict";
    $(function() {
        $(".preloader").fadeOut();
    });
    jQuery(document).on('click', '.mega-dropdown', function(e) {
        e.stopPropagation()
    });
    // ============================================================== 
    // This is for the top header part and sidebar part
    // ==============================================================  
    var set = function() {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        var topOffset = 75;
        if (width < 1170) {
            $("body").addClass("mini-sidebar");
            $('.navbar-brand span').hide();
        } else {
            $("body").removeClass("mini-sidebar");
            $('.navbar-brand span').show();
        }
        var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $(".page-wrapper").css("min-height", (height) + "px");
        }
    };
    $(window).ready(set);
    $(window).on("resize", set);
    // ============================================================== 
    // Theme options
    // ==============================================================     
    $(".sidebartoggler").on('click', function() {
        $("body").toggleClass("mini-sidebar");

    });

    // this is for close icon when navigation open in mobile view
    $(".nav-toggler").on('click', function() {
        $("body").toggleClass("show-sidebar");

        $(".nav-toggler i").toggleClass("ti-menu");
    });
    $(".nav-lock").on('click', function() {
        $("body").toggleClass("lock-nav");
        $(".nav-lock i").toggleClass("mdi-toggle-switch-off");
        $("body, .page-wrapper").trigger("resize");
    });
    $(".search-box a, .search-box .app-search .srh-btn").on('click', function() {
        $(".app-search").toggle(200);
        $(".app-search input").focus();
    });

    // ============================================================== 
    // Right sidebar options
    // ============================================================== 
    $(".right-side-toggle").click(function() {
        $(".right-sidebar").slideDown(50);
        $(".right-sidebar").toggleClass("shw-rside");
    });
    // ============================================================== 
    // This is for the floating labels
    // ============================================================== 
    $('.floating-labels .form-control').on('focus blur', function(e) {
        $(this).parents('.form-group').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
    }).trigger('blur');

    // ============================================================== 
    //tooltip
    // ============================================================== 
    $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        // ============================================================== 
        //Popover
        // ============================================================== 
    $(function() {
            $('[data-toggle="popover"]').popover()
        })
        // ============================================================== 
        // Resize all elements
        // ============================================================== 
    $("body, .page-wrapper").trigger("resize");
    // ============================================================== 
    // To do list
    // ============================================================== 
    $(".list-task li label").click(function() {
        $(this).toggleClass("task-done");
    });
    // ============================================================== 
    // Collapsable cards
    // ==============================================================
    $('a[data-action="collapse"]').on('click', function(e) {
        e.preventDefault();
        $(this).closest('.card').find('[data-action="collapse"] i').toggleClass('ti-minus ti-plus');
        $(this).closest('.card').children('.card-body').collapse('toggle');
    });
    // Toggle fullscreen
    $('a[data-action="expand"]').on('click', function(e) {
        e.preventDefault();
        $(this).closest('.card').find('[data-action="expand"] i').toggleClass('mdi-arrow-expand mdi-arrow-compress');
        $(this).closest('.card').toggleClass('card-fullscreen');
    });
    // Close Card
    $('a[data-action="close"]').on('click', function() {
        $(this).closest('.card').removeClass().slideUp('fast');
    });
    // ============================================================== 
    // Color variation
    // ==============================================================

    var mySkins = [
            "skin-default",
            "skin-green",
            "skin-red",
            "skin-blue",
            "skin-purple",
            "skin-megna",
            "skin-default-dark",
            "skin-green-dark",
            "skin-red-dark",
            "skin-blue-dark",
            "skin-purple-dark",
            "skin-megna-dark"
        ]
        /**
         * Get a prestored setting
         *
         * @param String name Name of of the setting
         * @returns String The value of the setting | null
         */
    function get(name) {
        if (typeof(Storage) !== 'undefined') {
            //return localStorage.getItem(name)
        } else {
            window.alert('Please use a modern browser to properly view this template!')
        }
    }
    /**
     * Store a new settings in the browser
     *
     * @param String name Name of the setting
     * @param String val Value of the setting
     * @returns void
     */
    function store(name, val) {
        if (typeof(Storage) !== 'undefined') {
            localStorage.setItem(name, val)
        } else {
            window.alert('Please use a modern browser to properly view this template!')
        }
    }

    /**
     * Replaces the old skin with the new skin
     * @param String cls the new skin class
     * @returns Boolean false to prevent link's default action
     */
    function changeSkin(cls) {
        $.each(mySkins, function(i) {
            $('body').removeClass(mySkins[i])
        })
        $('body').addClass(cls)
        store('skin', cls)
        return false
    }

    function setup() {
        var tmp = get('skin')
        if (tmp && $.inArray(tmp, mySkins)) changeSkin(tmp)
            // Add the change skin listener
        $('[data-skin]').on('click', function(e) {
            if ($(this).hasClass('knob')) return
            e.preventDefault()
            changeSkin($(this).data('skin'))
        })
    }
    setup()
    $("#themecolors").on("click", "a", function() {
        $("#themecolors li a").removeClass("working"),
            $(this).addClass("working")
    })

    var inputs = $("form .nextEnter").get()
    $("form").on("keydown", ".nextEnter", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            var which = inputs.indexOf(this),
                next = inputs[which + 1];
            if (next) {
                next.focus()
                next.parentElement.scrollIntoView({ behavior: "smooth" })
            }
        }
    })
});

//Config Toastr
toastr.options.closeButton = true;
toastr.options.debug = false;
toastr.options.newestOnTop = true;
toastr.options.progressBar = true;
toastr.options.positionClass = "toast-top-right";
toastr.options.preventDuplicates = false;
toastr.options.onclick = null;
toastr.options.showDuration = "300";
toastr.options.hideDuration = "1000";
toastr.options.timeOut = "4000";
toastr.options.extendedTimeOut = "1000";
toastr.options.showEasing = "swing";
toastr.options.hideEasing = "linear";
toastr.options.showMethod = "fadeIn";
toastr.options.hideMethod = "fadeOut";

//Toastr function
function toastAlert(level, msg) {
    switch (level.toLowerCase()) {
        case 'success':
            toastr.success(msg, 'Sucesso')
            break;
        case 'warning':
            toastr.warning(msg, 'Alerta')
            break;
        case 'info':
            toastr.info(msg, 'Info')
            break;
        case 'error':
            toastr.error(msg, 'Erro')
            break;
        default:
            toastr.error(msg, 'Erro')
            break;
    }
}

function customConfirm(title, text, callback) {
    swal({
        title: title,
        text: text,
        icon: "warning",
        buttons: ['Cancelar', 'OK'],
        dangerMode: true,
    }).then((isConfirm) => {
        if (isConfirm) {
            callback()
        }
    });
}

function invalidateInput(inputName, text) {
    $("[name='" + inputName + "']").addClass('input-invalidate');
    $("#fdbk" + inputName).text(text);
}

function clearAllInputsValidations(form) {
    $("form#" + form + " :input").each(function() {
        $(this).removeClass('input-invalidate');
        $('#fdbk' + $(this).attr('name')).text('');
    });
}

function clearAllInputsValues(form) {
    $("form#" + form + " :input").each(function() {
        $(this).val('');
        $(this).removeClass('input-invalidate');
        $('#fdbk' + $(this).attr('name')).text('');
    });
}

$('.input-date').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR",
    autoclose: true,
    toggleActive: true
});