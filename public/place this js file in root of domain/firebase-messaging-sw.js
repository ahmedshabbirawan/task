// Scripts for firebase and firebase messaging
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");

// Initialize the Firebase app in the service worker by passing the generated config
const firebaseConfig = {
    apiKey: "AIzaSyApxuBj27RF7ClTDreltczNETM3ZR2ZKaw",
    authDomain: "jobtask-d9023.firebaseapp.com",
    projectId: "jobtask-d9023",
    storageBucket: "jobtask-d9023.appspot.com",
    messagingSenderId: "825058826236",
    appId: "1:825058826236:web:6707dea46346d1b47ac479",
    measurementId: "G-HRW03PR3LZ"
};

firebase.initializeApp(firebaseConfig);

// Retrieve firebase messaging
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
  console.log("Received background message ", payload);

  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
 
});