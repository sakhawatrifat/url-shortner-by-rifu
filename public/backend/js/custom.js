// Datatable
setTimeout(function(){
    $('.data-table').closest('div').addClass('overflowX-auto');
    $('.data-table').closest('div').addClass('double-scroll');

    $('.double-scroll').doubleScroll();
}, 1000);

// Selecte2
//$('.select2').select2();
$(".select2").select2({
    templateResult: formatState,
    templateSelection: formatState
});

function formatState (opt) {
    if (!opt.id) {
        return opt.text;
    } 

    var optimage = $(opt.element).attr('data-src'); 
    //console.log(optimage)
    if(!optimage){
       return opt.text;
    } else {                    
        var $opt = $(
           '<span><img src="' + optimage + '" width="60px" /> ' + opt.text + '</span>'
        );
        return $opt;
    }
};

$(".select2").each(function(){
    var thisParent = $(this).closest('.select-wrap').find('select');
    var thisParentRequired = thisParent.attr('required');
    if(typeof thisParentRequired !== 'undefined' && thisParentRequired !== false){
        $(this).attr('required', 'required');
    }
});

$('.select2-tag').select2({
    tags: true
});

// $(document).on('select2:open', function(e) {
//     window.setTimeout(function () {
//         document.querySelector('input.select2-search__field').focus();
//     }, 0);
// });

// Summernote
$(document).ready(function() {
    var t = $('.summernote').summernote(
    {
        height: 200,
        focus: false
    });

    //$('.ckeditor').ckeditor();

    // $("#btn").click(function(){
    //     $('div.note-editable').height(150);
    // });
});

//Date range picker
$('#reservation').daterangepicker()
//Date range picker with time picker
$('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
        format: 'MM/DD/YYYY hh:mm A'
    }
});
//Date range as a button
$('#daterange-btn').daterangepicker({
    ranges   : {
    'Today'       : [moment(), moment()],
    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate  : moment()
},
function (start, end) {
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
});

//Datetme picker
$( document ).ready(function() {
    $(".basic-date").flatpickr({});
    $(".basic-date-time").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
    $(".basic-time").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
});

// // Slug Generate On Keyup Title
// $(document).on('keyup', '.for-slug', function() {
//     let slug = $(this).closest('form').find('.to-slug');
//     slug.val(
//         convertToSlug(
//             $(this).val()
//         )
//     )
// });
// // Slug Generate Fountion
// function convertToSlug(Text) {
//     // return Text.toLowerCase()
//     //            .replace(/ /g, '-')
//     //            .replace(/[^\w-]+/g, '');
    
//     return Text.toLowerCase()
//                 .trim()
//                 .replace(/ +/g, '_')
//                 .replace(/_+/g, '-')
// }




// Slug Generate On Keyup Title
$(document).on('keyup', '.to-slug', function() {
    let slug = $(this).closest('form').find('.to-slug');
    slug.val(
        convertToSlug(
            $(this).val()
        )
    )
});
// Slug Generate Fountion
function convertToSlug(Text) {
    return Text.toLowerCase()
               .replace(/ /g, '-')
               .replace(/[^\w-]+/g, '');
}


$('form.edit-form .to-slug').attr("readonly", "readonly");





// SetCookie
function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// GetCookie
function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

//
function deleteCookie(name) {
  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

// MF Img popup
// handle events
$(document).on('click','.mf-prev',function(){
    $('body').addClass('mf-popup-visible');
    var img_src = $(this).find('.image').attr('data-src');
    $('.mf-img-popup').children('img').attr('src', img_src);
    $('.mf-img-popup').addClass('opened');
});

$(document).on('click','.mf-img-popup, .mf-img-popup-close-btn',function(){
    $('body').removeClass('mf-popup-visible');
    $('.mf-img-popup').removeClass('opened');
    $('.mf-img-popup').children('img').attr('src', '');
});

$('.mf-img-popup img').on('click', function(e) {
    e.stopPropagation();
});


// Initiate Tooltip
$('[data-bs-toggle="tooltip"]').tooltip();

// Initiate Tooltip on Datatable load
$('table').on('draw.dt', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});

$(document).ready(function() {
    var $scroll = $('.sidebar');
    if ($('.menu-open').length)
       $scroll.scrollTop($('.menu-open').position().top + $scroll.scrollTop())
});



// function set_color(el){
//     let colorPicker=$(el).closest('.color-picker-wrapper').find(".color-picker");
//     let colorPickerinput=$(el).closest('.color-picker-wrapper').find(".color-picker-input");
//     let colorPickerWrapper=$(el).closest('.color-picker-wrapper');
//     let colorPickerAlpha=$(el).closest('.color-picker-wrapper').find(".color-picker-alpha");
//     console.log(colorPickerinput);
//     let colorValue = colorPicker.val() + (colorPickerAlpha.val() == 255 ? "" : parseInt(colorPickerAlpha.val()).toString(16).padStart(2, "0"));
//     $(colorPickerWrapper).css({"background-color": colorValue});
//     $(colorPickerinput).val(colorValue);
// }




// CKeditor
$(document).ready(function() {
    //$('.ckeditor').ckeditor();
    if($('.ckeditor').length > 0){
        var ckNum = 1;

        ckVarNames = [];
        $('.ckeditor').each(function(){
            let ckeditorNumber = Math.floor(Math.random() * 26) + Date.now();
            ckeditorNumber = `ckeditor${ckeditorNumber}${ckNum}`
            $(this).attr("data-id", ckeditorNumber);
            //CKEDITOR.replace(ckeditorNumber);
            //CKEDITOR.ClassicEditor.create(document.getElementById(ckeditorNumber), ckEditorParams());
            
            //ckNum++;

            CKEDITOR.ClassicEditor.create($(this)[0], ckEditorParams()).then( editor => {
                //console.log( 'Editor was initialized', editor );
                ckVarNames[ckeditorNumber] = editor;
                //console.log( ckVarNames[ckeditorNumber] );
            })
            .catch( err => {
                console.error( err.stack );
            });
        });
    }
    //CKEDITOR.ClassicEditor.create($('.ckeditor')[0], ckEditorParams());
});

function ckEditorParams(){
    return {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                'exportPDF','exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: '',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced'
        ]
    };
}


setTimeout(function(){
    var ckEditorCount = 0;
    $('.ck-editor').each(function(){
        let ckEditorNumber = `ckEditorAizUploader${ckEditorCount}`;
        $(this).find('.ck-file-dialog-button').empty();
        $(this).find('.ck-file-dialog-button').append(`<div class="ckeditor-aiz-uploader" data-id="${ckEditorNumber}" data-toggle="aizuploader" data-type="image" data-multiple="true"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 336H54a6 6 0 0 1-6-6V118a6 6 0 0 1 6-6h404a6 6 0 0 1 6 6v276a6 6 0 0 1-6 6zM128 152c-22.091 0-40 17.909-40 40s17.909 40 40 40 40-17.909 40-40-17.909-40-40-40zM96 352h320v-80l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L192 304l-39.515-39.515c-4.686-4.686-12.284-4.686-16.971 0L96 304v48z"/></svg></div>`);

        $(`<div class="ckeditor-screen-switch"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M200 32H56C42.7 32 32 42.7 32 56V200c0 9.7 5.8 18.5 14.8 22.2s19.3 1.7 26.2-5.2l40-40 79 79-79 79L73 295c-6.9-6.9-17.2-8.9-26.2-5.2S32 302.3 32 312V456c0 13.3 10.7 24 24 24H200c9.7 0 18.5-5.8 22.2-14.8s1.7-19.3-5.2-26.2l-40-40 79-79 79 79-40 40c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H456c13.3 0 24-10.7 24-24V312c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2l-40 40-79-79 79-79 40 40c6.9 6.9 17.2 8.9 26.2 5.2s14.8-12.5 14.8-22.2V56c0-13.3-10.7-24-24-24H312c-9.7 0-18.5 5.8-22.2 14.8s-1.7 19.3 5.2 26.2l40 40-79 79-79-79 40-40c6.9-6.9 8.9-17.2 5.2-26.2S209.7 32 200 32z"/></svg></div>`).insertBefore($(this).find('.ck-toolbar__line-break'));

        ckEditorCount++;
    });
}, 2000);

$(document).on('click', '.ckeditor-aiz-uploader', function(event) {
    setTimeout(function(){
        if ( $(event.target).closest(".ck-toolbar__items").find('.ckeditor-aiz-uploader').length > 0) {
            var thisUploaderBtn = $(event.target).closest(".ck-toolbar__items").find('.ckeditor-aiz-uploader');
            var thisUploaderID = $(event.target).closest(".ck-toolbar__items").find('.ckeditor-aiz-uploader').attr("data-id");
            $('.modal.aiz-modal').attr("data-id", thisUploaderID);
        }
    }, 1000);
});

$(document).on('click', '.aiz-uploader-select', function(e) {
    e.preventDefault();
    var thisAizImageId = $(this).closest('#aizUploaderModal').attr("data-id");
    var currentCkeditor = $(`.ckeditor-aiz-uploader[data-id=${thisAizImageId}]`).closest('.ck-editor');
    const currentCkEditorId = currentCkeditor.prevAll("textarea").first().attr('data-id');

    const thisAizImageSrc = $(this).find('img').attr('src');
    const thisAizImage = `<img src="${thisAizImageSrc}">`;

    const ckeditor = ckVarNames[currentCkEditorId];

    const viewFragment = ckeditor.data.processor.toView( thisAizImage );
    const modelFragment = ckeditor.data.toModel( viewFragment );
    ckeditor.model.change( writer => {
        ckeditor.model.insertContent( modelFragment );
    } );
});



$(document).on('click', '.ckeditor-screen-switch', function(e) {
    $('ck-toolbar__items')
    const editorElement = $(this).closest('.ck-editor');
    const editorElementClass = $(this).closest('.ck-editor')[0];

    $('body').toggleClass('ck-editor-full-width');
    editorElement.toggleClass('editor-full-width');

    $('.ck-editor__main').removeAttr('style');
    initCkContentEditorWidth();
    
});

$(window).on('resize', function(){
    initCkContentEditorWidth();
});

function initCkContentEditorWidth(){
    if($('.editor-full-width').length > 0){
        let ckToolHeight = $('.editor-full-width .ck-toolbar').height();
        var ckContentHeight = 100 / ckToolHeight;
        $('.editor-full-width .ck-editor__main').attr("style", `height:calc( 100vh - ${ckToolHeight}px )`)
    }
}

$(document).on('keyup', function(event) {
    event = event || window.event;
    var isEscape = false;
    if ("key" in event) {
        isEscape = (event.key === "Escape" || event.key === "Esc");
    } else {
        isEscape = (event.keyCode === 27);
    }
    if (isEscape) {
        $('.editor-full-width .ck-editor__main').removeAttr('style');
        $('body').removeClass('ck-editor-full-width');
        $('.ck-editor').removeClass('editor-full-width');
    }
});
