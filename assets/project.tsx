// assets/project.js

import jQuery from 'jquery';

// any CSS you import will output into a single css file (app.css in this case)
import './styles/project.scss';

import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class ShowArchivedProjectsButton extends Component {
  state = {
    archivedShown: false
  };

  constructor(props: any) {
    super(props);

    // This binding is necessary to make `this` work in the callback
    this.handleClick = this.handleClick.bind(this);
  }

  handleClick() {
    this.setState({
      archivedShown: !this.state.archivedShown
    });

    if (this.state.archivedShown) {
      jQuery('.project.archived').hide();
    } else {
      jQuery('.project.archived').show();
    }
  }

  render() {
    return (
      <button type="button" className='btn btn-info btn-sm' onClick={this.handleClick}>
        {this.state.archivedShown ? 'Hide archived' : 'Show archived'}
      </button>
    );
  }
}

ReactDOM.render(
  <ShowArchivedProjectsButton />,
  document.querySelector('#show_hide_archived_container')
);
