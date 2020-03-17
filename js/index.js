$(document).ready(function () {
    window.manifest = {
        language: "en"
    }

    $('#form input').on('keyup', update);
    $('input.color').on('change', update);

    function update() {
        window.manifest = $('#form').serializeArray().reduce(function(obj, item) {
            if (item.value === "") { return obj; }
            obj[item.name] = item.value;
            return obj;
        }, {});
        $('#manifest').val(JSON.stringify(window.manifest, null, 2));
        render();
    }

    function render() {
        $('#output').text(JSON.stringify(manifest, null, 2)).each(function(i, block) {
            hljs.highlightBlock(block);
        });
    }

    update();

})
