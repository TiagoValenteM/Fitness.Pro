$(document).ready(function () {
  // we use this cookie to control whether a client is perfoming login or registering
  // this is useful to be able to show errors related to login/register depending
  // on what the user is doing
  const state = getCookie('login_state') // state 1 - login, 2 - register
  if (state == 1) {
    $('#signup').hide()
  } else if (state == 2) {
    $('#signin').hide()
  } else {
    $('#signup').hide()
  }
  $('#new-user').click(function () {
    $('#signup').show()
    $('#signin').hide()
    document.cookie = 'login_state=2'
  })
  $('#old-user').click(function () {
    $('#signup').hide()
    $('#signin').show()
    document.cookie = 'login_state=1'
  })
})

// generic function to obtain a certain cookie by its name
// avoid repetition
function getCookie(cName) {
  const name = cName + '='
  const cDecoded = decodeURIComponent(document.cookie) //to be careful
  const cArr = cDecoded.split('; ')
  let res
  cArr.forEach((val) => {
    if (val.indexOf(name) === 0) res = val.substring(name.length)
  })
  return res
}
