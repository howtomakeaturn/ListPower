import React from 'react';
import ReactDOM from 'react-dom';
import App from './components/App';

if ($('#info-columns-setting-state').val()) {
  ReactDOM.render(<App sections={$('#info-columns-setting-state').val()} />, document.getElementById('info-columns-setting-app'));
} else {
  ReactDOM.render(<App />, document.getElementById('info-columns-setting-app'));
}
