<form id="configuration_form" action="{$action}" class="defaultForm form-horizontal" method="post">
    <div class="panel">
        <div class="form-wrapper">
            <div class="form-group">
                <label class="control-label col-lg-4 required">
                    API Host
                </label>
                <div class="col-lg-8">
                    <input type="text" name="FACTORING004_API_HOST" id="FACTORING004_API_HOST" value="{$configuration_value.factoring004_api_host}" class="" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4 required">
                    OAuth Token bnpl-partners
                </label>
                <div class="col-lg-8">
                    <textarea name="FACTORING004_PA_TOKEN" id="FACTORING004_PA_TOKEN" class="textarea-autosize" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 52.275px;">{$configuration_value.factoring004_pa_token}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4 required">
                    OAuth Token AccountingService
                </label>
                <div class="col-lg-8">
                    <textarea name="FACTORING004_AS_TOKEN" id="FACTORING004_AS_TOKEN" class="textarea-autosize" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 52.275px;">{$configuration_value.factoring004_as_token}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4 required">
                    Partner Name
                </label>
                <div class="col-lg-8">
                    <input type="text" name="FACTORING004_PARTNER_NAME" id="FACTORING004_PARTNER_NAME" value="{$configuration_value.factoring004_partner_name}" class="" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4 required">
                    Partner Code
                </label>
                <div class="col-lg-8">
                    <input type="text" name="FACTORING004_PARTNER_CODE" id="FACTORING004_PARTNER_CODE" value="{$configuration_value.factoring004_partner_code}" class="" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4 required">
                    Point Code
                </label>
                <div class="col-lg-8">
                    <input type="text" name="FACTORING004_POINT_CODE" id="FACTORING004_POINT_CODE" value="{$configuration_value.factoring004_point_code}" class="" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">
                    Partner Email
                </label>
                <div class="col-lg-8">
                    <input type="text" name="FACTORING004_PARTNER_EMAIL" id="FACTORING004_PARTNER_EMAIL" value="{$configuration_value.factoring004_partner_email}" class="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">
                    Partner Website
                </label>
                <div class="col-lg-8">
                    <input type="text" name="FACTORING004_PARTNER_WEBSITE" id="FACTORING004_PARTNER_WEBSITE" value="{$configuration_value.factoring004_partner_website}" class="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">
                    Способы доставки
                </label>
                {foreach from=$delivery_methods item=delivery}
                    <div class="col-lg-8">
                        <input {foreach from=$configuration_value.factoring004_delivery_methods item=delivery_id}
                            {if $delivery.id_carrier == $delivery_id} checked="checked" {/if} {/foreach} value="{$delivery.id_carrier}" type="checkbox" name="FACTORING004_DELIVERY_METHODS[]" id="FACTORING004_DELIVERY_METHOD_{$delivery.id_carrier}" class="">
                        <label for="FACTORING004_DELIVERY_METHOD_{$delivery.id_carrier}">{$delivery.name}</label>
                    </div>
                {/foreach}
            </div>
            <div class="form-group">
                <input type="hidden" id="factoring004_file_name" name="FACTORING004_OFFER_FILE_NAME" value="{$configuration_value.factoring004_offer_file}">
                <label class="control-label col-lg-4">
                    Файл оферты
                </label>
                <div class="col-lg-8">
                    {if $configuration_value.factoring004_offer_file}
                        <a href="/modules/factoring004/storage/{$configuration_value.factoring004_offer_file}" target="_blank" class="btn btn-default">Просмотреть</a>
                        <button id="factoring004_offer_file_delete" type="button" class="btn btn-danger">Удалить</button>
                    {else}
                        <button onclick="document.getElementById('FACTORING004_OFFER_FILE').click()" type="button" class="btn btn-primary">Выбрать файл</button>
                        <input value="" style="display:none;" type="file" name="FACTORING004_OFFER_FILE" id="FACTORING004_OFFER_FILE">
                        <p class="help-block">
                            Загрузите файл оферты, если вам необходимо его отобразить клиенту
                        </p>
                    {/if}
                </div>
            </div>
            <div class="panel-footer">
                <button id="factoring004_submit" name="btnSubmit" type="submit" class="btn btn-default pull-right">
                    Сохранить
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).on('change','#FACTORING004_OFFER_FILE', function (e) {
        let action = '{$file_upload}';
        let fd = new FormData();
        let files = $(e.target.files);
        if (files.length > 0) {
            fd.append('file',files[0]);
            $.ajax({
                url: action,
                data: fd,
                method: 'post',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#factoring004_submit').prop('disabled', true);
                },
                success: function(data) {
                    $('#factoring004_file_name').val(data)
                },
                error: function (e) {
                    alert(e.message)
                },
                complete: function () {
                    $('#factoring004_submit').prop('disabled', false);
                }
            });
        }
    })

    $(document).on('click', '#factoring004_offer_file_delete', function () {
        let filename = '{$configuration_value.factoring004_offer_file}';
        let action = '{$file_destroy}';
        $.ajax({
            url: action,
            data: filename,
            method: 'post',
            beforeSend: function () {
                $('#factoring004_submit').prop('disabled', true);
            },
            success: function(data) {
                $('#factoring004_file_name').val(data)
            },
            error: function (e) {
                alert(e.message)
            },
            complete: function () {
                $('#factoring004_submit').prop('disabled', false);
            }
        });
    })
</script>