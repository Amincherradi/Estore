
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Mailbox</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Mailbox</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <a class="btn btn-info btn-block" href="?p=Compose"><i class="fa fa-edit"></i> Compose</a><br>
                        <h6 class="m-t-10 m-b-10">FOLDERS</h6>
                        <ul class="list-group list-group-divider inbox-list">
                            <li class="list-group-item">
                                <a href="javascript:;"><i class="fa fa-inbox"></i> Inbox (0)
                                    <span class="badge badge-warning badge-square pull-right">17</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="javascript:;"><i class="fa fa-envelope-o"></i> Sent</a>
                            </li>
                            <li class="list-group-item">
                                <a href="javascript:;"><i class="fa fa-star-o"></i> Important
                                    <span class="badge badge-success badge-square pull-right">2</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="javascript:;"><i class="fa fa-file-text-o"></i> Drafts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="javascript:;"><i class="fa fa-trash-o"></i> Trash</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="ibox" id="mailbox-container">
                            <div class="mailbox-header">
                                <div class="d-flex justify-content-between">
                                    <h5 class="d-none d-lg-block inbox-title"><i class="fa fa-envelope-o m-r-5"></i> Inbox (0)</h5>
                                    <form class="mail-search" action="javascript:;">
                                        <div class="input-group">
                                            <input class="form-control" type="text" placeholder="Search email">
                                            <div class="input-group-btn">
                                                <button class="btn btn-info">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="d-flex justify-content-between inbox-toolbar p-t-20">
                                    <div class="d-flex">
                                        <label class="ui-checkbox ui-checkbox-info check-single p-t-5 m-r-20">
                                            <input type="checkbox" data-select="all">
                                            <span class="input-span"></span>
                                        </label>
                                        <div id="inbox-actions">
                                            <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Mark as read"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Mark as important"><i class="fa fa-star-o"></i></button>
                                            <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Reply"><i class="fa fa-reply"></i></button>
                                            <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
                                        </div>
                                        <span class="counter-selected m-l-5" hidden="">Selected
                                            <span class="font-strong text-warning counter-count">3</span>
                                        </span>
                                    </div>
                                    <div>
                                        <span class="p-r-10 font-13">1 of 1</span>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-default"><i class="fa fa-chevron-left"></i></button>
                                            <button class="btn btn-default"><i class="fa fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mailbox clf">
                                <table class="table table-hover table-inbox" id="table-inbox">
                                    <tbody class="rowlinkx" data-link="row">
                                        <tr data-id="1">
                                            <td class="check-cell rowlink-skip">
                                                <label class="ui-checkbox ui-checkbox-info check-single">
                                                    <input class="mail-check" type="checkbox">
                                                    <span class="input-span"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="mail_view.html">Emma Johnson</a>
                                            </td>
                                            <td class="mail-message">Fusce suscipit semper erat, vel solo.</td>
                                            <td class="hidden-xs"></td>
                                            <td class="mail-label hidden-xs"><i class="fa fa-circle text-success"></i></td>
                                            <td class="text-right">5.22 AM</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <ul class="pagination justify-content-end m-t-0 m-r-10">
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:;" aria-label="Previous">
                                            <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                                        </a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="javascript:;">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:;">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:;">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:;">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:;" aria-label="Next"><i class="fa fa-angle-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>