import * as React from 'react';
import * as Redux from 'redux';
import { connect } from 'react-redux';
import {State} from '../Reducers';
import * as Types from '../Reducers/Wechat/Types';
import {SelectParam} from 'antd/lib/menu';

import { Tabs, Button, Icon, Menu, Table, Badge, Input } from 'antd';
const TabPane = Tabs.TabPane;

const Search = Input.Search;

interface OwnProps {
    contacts: Types.Contact[],
    chatting_contacts: Types.Contact[],
    selected_contcat: Types.Contact | null,
    start_chat: (user_name:string) => void
    finish_chat: (user_name:string) => void,
    height: number
}
interface OwnState {
    search: string | null
}

type WechatContactsProps = OwnProps

class WechatContacts extends React.Component<WechatContactsProps, OwnState> {

    constructor() {
        super();
    }

    handleRowClick(contact: Types.Contact, index: number) {
        this.props.start_chat(contact.UserName);
    }

    handleStatChat(e: SelectParam) {
        this.props.start_chat(e.key);
    }

    handleFinishChat(e: React.MouseEvent<any>, user_name: string) {
        e.stopPropagation();
        this.props.finish_chat(user_name)
    }

    render() {

        const columns = [{
            title: 'Name',
            key: 'UserName',
            render: (text, record, index) => {
                if (!this.props.selected_contcat || this.props.selected_contcat.UserName != record.UserName) {
                return <div>{record.RemarkName || record.NickName }</div>;
                } else {
                return <div style={{backgroundColor: '#b8d3f9'}}>{record.RemarkName || record.NickName}</div>
                }
            }
        }];

        let selected_keys = this.props.selected_contcat ? [this.props.selected_contcat.UserName] : [];


        let contacts =  this.props.contacts;

        contacts = contacts.sort((a, b) => {
            let a_name = a.RemarkPYInitial || a.PYInitial || a.NickName
            let b_name = b.RemarkPYInitial || b.PYInitial || a.NickName
            return a_name > b_name ? 1 : (a_name == b_name ? 0 : -1)
        });

        let pagination = false as any;
        if (contacts.length > 10) {
            pagination = {
                pageSize: Math.floor((this.props.height - 40 - 37 - 28) / 50),
                simple: true
            }
        }

        let contacts_menu =
            <Table columns={columns}
                showHeader={false}
                dataSource={contacts as any}
                pagination={pagination}
                onRowClick={this.handleRowClick.bind(this)}
            />


        let style = {
            maxHeight: this.props.height - 37,
            overflowY: 'scroll'
        }

        let chatting_menu =
             <Menu mode="inline" selectedKeys={selected_keys} onClick={this.handleStatChat.bind(this)} style={style}>
                {
                    this.props.chatting_contacts.map((u) => {
                        if (!u.hasUnread) {
                            return (
                                <Menu.Item key={u.UserName}>
                                    {u.RemarkName || u.NickName}
                                    <Icon type="close" onClick={(e) => this.handleFinishChat(e, u.UserName)}/>
                                </Menu.Item>
                            )
                        } else {
                            return (
                                <Menu.Item key={u.UserName}>
                                    <Badge status="error" count={0} />
                                    {u.RemarkName || u.NickName}
                                    <Icon type="close" onClick={(e) => this.handleFinishChat(e, u.UserName)}/>
                                </Menu.Item>
                            )
                        }
                    })
                }
            </Menu>

        return (
            <div className={'wechat_contacts'}>
                <Tabs animated={false}>
                    <TabPane tab={<Icon type="message" />} key="1">{chatting_menu}</TabPane>
                    <TabPane tab={<Icon type="team" />} key="2">
                        {contacts_menu}
                    </TabPane>
                </Tabs>
            </div>
        )
    }
}


export default WechatContacts;
