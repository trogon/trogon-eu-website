// assets/project.ts
"use strict";

import './styles/project.scss';

import jQuery from 'jquery';

import React, { Component } from 'react';
import { createRoot } from 'react-dom/client';

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

jQuery(function () {
  const showHideArchivedContainer = document.querySelector('#show_hide_archived_container');

  const root = createRoot(showHideArchivedContainer!);
  root.render(<ShowArchivedProjectsButton />);
});
