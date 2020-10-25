'use strict';

import jQuery from 'jquery';

import React from 'react';
import ReactDOM from 'react-dom';

const __API__ = process.env.__API__;
var itemsPerPage = 9;

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

interface NewsPaginationProps {
    currentPage: number;
    itemsPerPage: number;
    totalItems: number;
}

interface NewsPaginationLinkProps {
    currentPage: number;
    page?: number;
    itemsPerPage: number;
    totalPages: number;
}

function NewsPaginationPrevious(props: NewsPaginationLinkProps): JSX.Element {
    const { currentPage, itemsPerPage, totalPages } = props;

    if (currentPage > 1) {
        return (<li className="page-item"><a className="page-link" href="#">Previous</a></li>);
    } else {
        return (<li className="page-item disabled"><a className="page-link" href="#">Previous</a></li>);
    }
}

function NewsPaginationNext(props: NewsPaginationLinkProps): JSX.Element {
    const { currentPage, itemsPerPage, totalPages } = props;

    if (currentPage < totalPages) {
        return (<li className="page-item"><a className="page-link" href="#">Next</a></li>);
    } else {
        return (<li className="page-item disabled"><a className="page-link" href="#">Next</a></li>);
    }
}

function NewsPaginationLink(props: NewsPaginationLinkProps): JSX.Element {
    const { currentPage, page, itemsPerPage, totalPages } = props;

    if (currentPage != page) {
        return (<li className="page-item"><a className="page-link" href="#">{page}</a></li>);
    } else {
        return (<li className="page-item disabled"><a className="page-link" href="#">{page}</a></li>);
    }
}

function NewsPagination(props: NewsPaginationProps): JSX.Element {
    const { currentPage, itemsPerPage, totalItems } = props;
    let totalPages = Math.ceil(totalItems / itemsPerPage);
    let pages = Array(totalPages).fill(1).map((x, y) => x + y);

    return (
        <nav aria-label="Page navigation example">
            <ul className="pagination justify-content-center">
                <NewsPaginationPrevious currentPage={currentPage} itemsPerPage={itemsPerPage} totalPages={totalPages} />
                {pages.map(item => <NewsPaginationLink key={item} currentPage={currentPage} page={item} itemsPerPage={itemsPerPage} totalPages={totalPages} />)}
                <NewsPaginationNext currentPage={currentPage} itemsPerPage={itemsPerPage} totalPages={totalPages} />
            </ul>
        </nav>
    );
}

jQuery(function () {
    let page = 1;
    let newsDomContainer = document.querySelector('#news');

    itemsPerPage = jQuery('#news').data("items-per-page") ?? itemsPerPage;

    fetch(`${__API__}/news?page=${page}&itemsPerPage=${itemsPerPage}`, {
        "method": "GET"
    })
        .then(response => response.json())
        .then(response => {
            ReactDOM.render(<div><NewsFeed news={response["hydra:member"]} /><NewsPagination currentPage={page} itemsPerPage={itemsPerPage} totalItems={response["hydra:totalItems"]} /></div>, newsDomContainer);
        })
        .catch(err => {
            console.log(err);
        });
});
