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
                    OAuth Login
                </label>
                <div class="col-lg-8">
                    <input type="text" name="FACTORING004_OAUTH_LOGIN" id="FACTORING004_OAUTH_LOGIN" class="" required="required" value="{$configuration_value.factoring004_oauth_login}" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4 required">
                    OAuth Password
                </label>
                <div class="col-lg-8">
                    <input type="password" name="FACTORING004_OAUTH_PASSWORD" id="FACTORING004_OAUTH_PASSWORD" class="" required="required" value="{$configuration_value.factoring004_oauth_password}" >
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
                    Вид интерфейса клиентского пути
                </label>
                <div class="col-lg-8">
                    <select name="FACTORING004_CLIENT_ROUTE" id="FACTORING004_CLIENT_ROUTE">
                        <option {if $configuration_value.factoring004_client_route == 'REDIRECT'} selected {/if} value="REDIRECT">Перенаправление</option>
                        <option {if $configuration_value.factoring004_client_route == 'MODAL'} selected {/if} value="MODAL">Модальное окно</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">
                    Статус оплаченных заказов
                </label>
                <div class="col-lg-8">
                    <select name="FACTORING004_PAID_ORDER_STATUS" id="FACTORING004_PAID_ORDER_STATUS">
                        {foreach from=$statuses item=status}
                            {if $configuration_value.factoring004_paid_order_status}
                                <option {if $status.id_order_state == $configuration_value.factoring004_paid_order_status} selected {/if} value="{$status.id_order_state}">{$status.name}</option>
                            {else}
                                <option {if $status.name|in_array:['Payment accepted', 'Платеж принят']} selected {/if} value="{$status.id_order_state}">{$status.name}</option>
                            {/if}
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">
                    Статус неуспешных заказов
                </label>
                <div class="col-lg-8">
                    <select name="FACTORING004_DECLINED_ORDER_STATUS" id="FACTORING004_DECLINED_ORDER_STATUS">
                        {foreach from=$statuses item=status}
                            {if $configuration_value.factoring004_declined_order_status}
                                <option {if $status.id_order_state == $configuration_value.factoring004_declined_order_status} selected {/if} value="{$status.id_order_state}">{$status.name}</option>
                            {else}
                                <option {if $status.name|in_array:['Payment error', 'Ошибка оплаты']} selected {/if} value="{$status.id_order_state}">{$status.name}</option>
                            {/if}
                        {/foreach}
                    </select>
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