import React from 'react';
import ReactDOM from 'react-dom';
import App from './components/App';

if ($('#review-columns-setting-state').val()) {
  ReactDOM.render(<App columns={$('#review-columns-setting-state').val()} />, document.getElementById('review-columns-setting-app'));
} else {
  ReactDOM.render(<App />, document.getElementById('review-columns-setting-app'));
}
