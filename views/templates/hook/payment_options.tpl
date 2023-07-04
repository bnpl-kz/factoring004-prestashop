<form {if $clientRoute == 'MODAL'}onsubmit="return factoring004ShowModal(this)"{/if} method="post" action="{$action}">
    <P>Купи сейчас, плати потом! Быстрое и удобное оформление рассрочки на 4 месяца. Моментальное одобрение, без комиссий и процентов. Для заказов суммой от 6 000 до 200 000 тг.</P>
</form>
{if $clientRoute == 'MODAL'}
    <script src="{$paymentWidgetJs}" type="text/javascript"></script>
    <div id='modal-bnplpayment'></div>
    <script>
        function factoring004ShowModal(form)
        {
            fetch(form.action,{
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new FormData(form),
            })
                .then(response => response.json())
                .then((result) => {
                    if (result.redirectErrorPage) {
                        return window.location.replace(result.redirectErrorPage)
                    }
                    const bnplKzApi = new BnplKzApi.CPO(
                        {
                            rootId: 'modal-bnplpayment',
                            callbacks: {
                                onError: () => window.location.replace(result.redirectLink),
                                onDeclined: () => window.location.replace('/'),
                                onEnd: () => window.location.replace('/')
                            }
                        });
                    bnplKzApi.render({
                        redirectLink: result.redirectLink
                    });
                })
                .catch((err) => {
                    window.location.href = window.location.replace('/');
                })
            return false;
        }
    </script>
{/if}