<form onsubmit="return factoring004ValidateCheckOfferFile(this)" method="post" action="{$action}">
    <P>Купи сейчас, плати потом! Быстрое и удобное оформление рассрочки на 4 месяца без первоначальной оплаты. Моментальное подтверждение, без комиссий и процентов. Для заказов суммой от 6000 до 200000 тг.</P>
    {if $offerFileName}
        <label for="factoring004-offer-file">
            <input class="factoring004-offer-file" type="checkbox" id="factoring004-offer-file">
            Я ознакомлен и согласен с условиями <a target="_blank" href="/modules/factoring004/storage/{$offerFileName}">Рассрочка 0-0-4</a>
        </label>
    {/if}
</form>

<script>
    let totalPrice = '{$totalPrice}';
    const minTotal = 6000;
    const maxTotal = 200000;
    let payment = document.querySelector('[data-module-name="Рассрочка 0-0-4"]');
    let label = payment.parentElement.nextElementSibling.nextElementSibling;
    let dateSpan = document.createElement('span')
    dateSpan.style.cssText = 'color:red;font-size: 12px;';

    if (totalPrice < minTotal) {
        payment.disabled = true
        dateSpan.textContent = '(Минимальная сумма покупки в рассрочку 6000 Тенге. Не хватает ' + (minTotal - totalPrice) + ' тенге)';
        label.appendChild(dateSpan)
    }

    if (totalPrice > maxTotal) {
        payment.disabled = true
        dateSpan.textContent = '(Максимальная сумма покупки в рассрочку 200000 Тенге. Сумма превышает ' + (maxTotal - totalPrice) + ' тенге)';
        label.appendChild(dateSpan)
    }

    function factoring004ValidateCheckOfferFile(form)
    {
        let offerFileInput = document.querySelector('#factoring004-offer-file');
        if (!offerFileInput.checked) {
            alert('Вы должны согласиться с условиями Рассрочка 0-0-4')
            window.addEventListener('click', function (e) {
                    if (e.target.classList.contains('disabled')) {
                        e.target.classList.remove('disabled')
                    }
                }
            )
            return false;
        }
        form.submit()
    }

</script>
