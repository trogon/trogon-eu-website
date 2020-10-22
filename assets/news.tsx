'use strict';

import jQuery from 'jquery';

import React from 'react';
import ReactDOM from 'react-dom';

const __API__ = process.env.__API__;
const itemsPerPage = 9;

interface NewsModel {
    id: number;
    title: string;
    summary: string;
    createdOn: string;
}

interface NewsProps {
    data: NewsModel;
}

function News(props: NewsProps): JSX.Element {
    return (
        <div className="col-md-4">
            <div className="card mb-4 shadow-sm">
                <div className="card-header">
                    {props.data.title}
                </div>
                <div className="card-body">
                    <p className="card-text" dangerouslySetInnerHTML={{ __html: props.data.summary }}></p>
                    <div className="d-flex justify-content-between align-items-center">
                        <small className="text-muted">{props.data.createdOn}</small>
                    </div>
                </div>
            </div>
        </div>
    );
}

interface NewsFeedProps {
    news: Array<NewsModel>;
}

function NewsFeed(props: NewsFeedProps): JSX.Element {
    const { news } = props;
    return (<div className="row">{news.map(item => <News key={item.id} data={item} />)}</div>);
}

jQuery(function () {
    var page = 1;

    fetch(`${__API__}/news?page=${page}&itemsPerPage=${itemsPerPage}`, {
        "method": "GET"
    })
        .then(response => response.json())
        .then(response => {
            let newsDomContainer = document.querySelector('#news');
            ReactDOM.render(<NewsFeed news={response["hydra:member"]} />, newsDomContainer);
        })
        .catch(err => {
            console.log(err);
        });
});
