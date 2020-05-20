$(document).ready(function () {

    function imageCropper() {
        function readFile(input) {
            var $container = $(input).closest('.image-cropper-container');
            var $preview = $('.image-cropper-preview', $container);
            var imageCropper = $container.data('imageCropper');

            if (input.files && input.files[0]) {
                if (typeof imageCropper === 'undefined') {
                    imageCropper = $preview.croppie({
                        enableExif: true,
                        viewport: {
                            width: 200,
                            height: 200,
                            type: 'circle'
                        },
                        boundary: {
                            height: 200
                        }
                    });
                    $container.data('imageCropper', imageCropper);
                }

                var reader = new FileReader();

                reader.onload = function (e) {
                    $preview.addClass('ready');
                    imageCropper.croppie('bind', {
                        url: e.target.result
                    }).then(function () {
                        console.log('jQuery bind complete');
                    });

                };

                reader.readAsDataURL(input.files[0]);
                $container.addClass('cropper-inited');
            } else {
                if (typeof imageCropper !== 'undefined') {
                    imageCropper.croppie('destroy');
                }
                $container.removeData('imageCropper');
                $container.removeClass('has-image');
                $container.removeClass('cropper-inited');
                $('.image-croper-cropdata-remove', $container).val(1);

            }
        }

        $(document).on('change', '.image-cropper-file', function () {
            readFile(this);
        });
        $(document).on('click', '.image-cropper-remove-image', function () {
            var $container = $(this).closest('.image-cropper-container');
            $('.image-cropper-file', $container).val('').trigger('change');
        });
        $(document).on('update.croppie', '.image-cropper-preview', function (ev, cropData) {
            var $container = $(this).closest('.image-cropper-container');
            $('.image-croper-cropdata-x', $container).val(cropData.points[0]);
            $('.image-croper-cropdata-y', $container).val(cropData.points[1]);

            $('.image-croper-cropdata-w', $container).val(cropData.points[2]);
            $('.image-croper-cropdata-h', $container).val(cropData.points[3]);

            $('.image-croper-cropdata-scale', $container).val(cropData.zoom);
        });
    }

    imageCropper();
});
