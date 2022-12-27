const FILES_TO_CACHE = [
  '/offline.html'
]
const CACHE_NAME = 'sowonpay'

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(FILES_TO_CACHE)
    })
  )
})

self.addEventListener('activate', event => {
  const onActivate = async () => {

  }

  event.waitUntil(onActivate())
})

self.addEventListener('sync', function (event) {

})

self.addEventListener('periodicsync', async event => {
  const onPeriodicSync = async () => {
  }

  event.waitUntil(onPeriodicSync())
})

self.addEventListener('fetch', event => {
  if (event.request.mode !== 'navigate') { return }

  event.respondWith(
    fetch(event.request)
      .catch(async () => {
        return caches.open(CACHE_NAME)
          .then(cache => {
            return cache.match('/offline.html')
          })
      })
  )
})