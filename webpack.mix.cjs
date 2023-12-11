const mix = require('laravel-mix');

// sudent : 
mix.js([
    'resources/assets/js/student-js/clearlocalStorage.js',
    'resources/assets/js/student-js/nav.js',
    'resources/assets/js/student-js/profileAutoUpload.js',
    'resources/assets/js/student-js/searchJquery.js'
], 'public/mix-js/stutentAll.js');

mix.combine([
    'resources/assets/css/student-css/archieve.css',
    'resources/assets/css/student-css/content.css',
    'resources/assets/css/student-css/liveButton.css',
    'resources/assets/css/student-css/nav.css',
    'resources/assets/css/student-css/navEn.css',
    'resources/assets/css/student-css/profileBorder.css',
    'resources/assets/css/student-css/exam-css/style.css',
], 'public/mix-css/studentAll.css');

// admin :

mix.combine([
    'resources/assets/css/admin-css/addExam-part.css',
    'resources/assets/css/admin-css/adminDot.css',
    'resources/assets/css/admin-css/adminManager-part.css',
    'resources/assets/css/admin-css/chat.css',
    'resources/assets/css/admin-css/controlPagnation.css',
    'resources/assets/css/admin-css/payment-part.css',
    'resources/assets/css/admin-css/showAllData-part.css',
    'resources/assets/css/admin-css/timeTable.css'
], 'public/mix-css/AdminAll.css');


mix.combine([
    'resources/assets/js/admin-js/activationManager.js',
    'resources/assets/js/admin-js/addJs.js',
    'resources/assets/js/admin-js/alertC.js',
    'resources/assets/js/admin-js/alertConfirm.js',
    'resources/assets/js/admin-js/examAskQ.js',
    'resources/assets/js/admin-js/reportScripts.js',
    'resources/assets/js/admin-js/scrollBestStudent.js',
    'resources/assets/js/admin-js/searchJquery.js',
    'resources/assets/js/admin-js/timeTable.js'
], 'public/mix-js/AdminAll.js');
