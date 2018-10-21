// import fetch from 'fetch'

import origFetch from 'isomorphic-fetch'

export function fetch (url, options) {
  options = options || {}
  options.headers = options.headers || {}
  options.headers['X-Requested-With'] = 'XMLHttpRequest'
  options.credentials = 'same-origin'

  return origFetch(url, options)
}

export function fetchPost (url, formName, formData) {
  let options = {}
  if (formData) {
    const fData = new FormData()

    const data = convertToFormNames(formData)
    for (let key in data) {
      if (data.hasOwnProperty(key)) {
        const name = formName ? formName + key : key
        // null, as well as bool values, are treated on backend as string
        // which breaks check on emptiness
        const val  = data[key] !== null ? data[key] : ''
        fData.append(name, val)
      }
    }

    options = {
      method: 'POST',
      credentials: 'same-origin',
      body: fData
    }

    return fetch(url, options)
  }
}

function convertToFormNames (obj) {
    const out = {}
    if (obj instanceof Object && !(obj instanceof File) && !(obj instanceof Blob)) {
      for (let key in obj) {
        if (obj.hasOwnProperty(key)) {
          let arr = convertToFormNames(obj[key])
          for (let key2 in arr) {
            if (arr.hasOwnProperty(key2)) {
              out['[' + key + ']' + key2] = arr[key2]
            }
          }
        }
      }
    } else {
      out[''] = obj
    }

    return out
  }

  export function postSubmit (path, formName, formData) {
    const form = document.createElement("form")
    form.setAttribute("method", 'POST')
    form.setAttribute("action", path)
    // form.setAttribute("enctype", 'multipart/form-data')

    const params = convertToFormNames(formData)

    for (var key in params) {
      if (params.hasOwnProperty(key)) {
        const hiddenField = document.createElement("input")
        if (params[key] instanceof Blob) {
          hiddenField.setAttribute("type", "file")
        } else {
          hiddenField.setAttribute("type", "hidden")
        }
        hiddenField.setAttribute("name", formName + key)
        hiddenField.setAttribute("value", params[key])
        form.appendChild(hiddenField)
      }
    }

    document.body.appendChild(form)
    form.submit()
}
