define(function(require) {
    var $ = require('jquery');
    var PubSub = require('thirdparty/jquery/jquery.tinypubsub');

    var FileUpload = {

        config: {
            filePath:       null,
            fileUpload:     $('.file-upload'),
            selectFile:     $('[data-event*="select-file"]'),
            dropZone:       $('[data-event*="drop-zone"]')
        },

        init: function(element, config) {
            if(typeof config === 'object') {
                this.config = config;
            }

            this.config.fileInput = $(element);
            this.setup();
        },

        setup: function() {
            this.bindEvents();
            this.subscriptions();
            this.displayImage();
        },

        displayImage: function() {
            if (this.config.filePath != null) {
                this.config.fileUpload.hide();
                $('.file-preview').remove();

                var imagePreview = $('<img class="file-preview" data-event="select-file">');
                imagePreview.attr('src', this.config.filePath);
                imagePreview.appendTo('.file-preview-container');
            }
        },

        bindEvents: function() {

            var el = this.config;

            $('body').on('click', el.selectFile, function(event) {
                if($(event.target).is('[data-event*="select-file"]')) {
                    event.preventDefault();
                    $.publish('FileUpload/select-file');
                }
            });

            el.fileInput.on('change', function(event) {
                $.publish('FileUpload/file-ready');
            });

            // Drag and Drop Events.
            el.dropZone.on('drop dragover dragenter', function(event) {
                event.preventDefault();
                event.stopPropagation();
                el.selectFile.addClass('active');
            })

            .on('dragleave', function(){
                el.selectFile.removeClass('active');
            })

            .on('drop', function(event) {
                el.selectFile.removeClass('active');

                el.droppedFile = event.originalEvent.dataTransfer.files;

                $.publish('FileUpload/file-ready');
            });
        },

        subscriptions: function() {
            $.subscribe('FileUpload/select-file', this.browseForFile);
            $.subscribe('FileUpload/file-ready', this.uploadFile);
        },

        getFileData: function() {
            var el = FileUpload.config;

            if(el.droppedFile != null) {
                return el.droppedFile[0];
            }

            return el.fileInput[0].files[0];
        },

        browseForFile: function() {
            FileUpload.config.fileInput.click();
        },

        uploadFile: function() {

            var formData = new FormData();
            var file = FileUpload.getFileData();

            formData.append('files', file);

            $.ajax({
                type: 'POST',
                /* live: url: '/file/add_profile_photo', */
                url: '/2014/urban/file/add_profile_photo',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    FileUpload.renderLoader();
                },
                success: function(response) {
                    if(response.length) {
                        FileUpload.config.filePath = response;
                        FileUpload.displayImage();
                        FileUpload.config.droppedFile = null;
                    }

                    else{
                        FileUpload.renderError();
                    }
                }
            });
        },

        renderLoader: function() {
            var fileUpload = FileUpload.config;
            fileUpload.fileUpload.find('i').attr('class', 'fa fa-spinner fa-spin');
            fileUpload.selectFile.show();
            $('.file-preview').remove();
        },

        renderError: function() {
            var fileUpload = FileUpload.config;
            fileUpload.selectFile.addClass('error');
            fileUpload.fileUpload.find('i').attr('class', 'fa fa-exclamation-triangle');
            fileUpload.fileInput.val('');
            fileUpload.selectFile.show();
            $('.file-preview').remove();
        }
    };

    $.fn.fileupload = function(config) {
        return this.each(function() {
            FileUpload.init(this, config);
        });
    }

    $(document).ready(function() {
        $('#file-upload').fileupload();
    });
});