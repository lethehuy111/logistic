export function formatMoney(number) {
  return number.toLocaleString('vi', {style: 'currency', currency: 'VND'})
}
