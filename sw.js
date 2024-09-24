self.addEventListener("push", (event) => {
    const notification = event.data.json();
    const delay = notification.delay || 0; // Default to 0 seconds if not provided

    event.waitUntil(
        new Promise((resolve) => {
            setTimeout(() => {
                self.registration.showNotification(notification.title, {
                    body: notification.body,
                    icon: "icon.png",
                    data: {
                        notifURL: notification.url
                    }
                });
                resolve();
            }, delay * 1000); // Delay time in milliseconds
        })
    );
});

self.addEventListener("notificationclick", (event) => {
    event.waitUntil(clients.openWindow(event.notification.data.notifURL));
});

// Install and activate events with manual control
self.addEventListener('install', (event) => {
    event.waitUntil(
        self.skipWaiting() // Immediately activate new service worker
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        self.clients.claim() // Take control of all clients immediately
    );
});

// Optional: Handle service worker updates manually
self.addEventListener('controllerchange', () => {
    console.log('Service worker updated');
});
