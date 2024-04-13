export function renderSelect2({select, url}) {
    $(select).select2({
        ajax: {
            url,
            dataType: 'json',
            type: 'GET',
            processResults: function (data) {
                return {
                    results: data.map(item => ({
                        text: item.text,
                        id: item.id
                    }))
                };
            }
        },
    });
}