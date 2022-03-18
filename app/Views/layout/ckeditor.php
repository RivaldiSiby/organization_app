<style>
    .ck-editor__editable_inline {
        min-height: 200px;
        color: black;
    }
</style>
<!-- ckeditor -->


<script>
    if (document.querySelector('#editor')) {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

    }
</script>