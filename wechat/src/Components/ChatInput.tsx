import * as React from 'react';
import * as Redux from 'redux';
import { connect } from 'react-redux';
import { State } from '../Reducers';
import * as Types from '../Reducers/Wechat/Types';
import {Button, Icon} from 'antd';
import * as Electron from 'electron';
import * as ChatInputReducer from '../Reducers/ChatInput';

const {dialog} = require('electron').remote

interface OwnProps {
    user: Types.User,
    contact: Types.Contact,
    send_text: (uin, username, content) => void,
    send_image: (uin, username, filepath) => void,
}
interface OwnState { }
interface ConnectedState {
    chat_input: string
}
interface ConnectedDispatch {
    update_input: (string) => void
}
type ChatInputProps = ConnectedState & ConnectedDispatch & OwnProps

class ChatInput extends React.Component<ChatInputProps, OwnState> {

    handleSend() {
        let textarea = this.refs['textarea'] as  HTMLTextAreaElement;
        if (textarea.value.length > 0) {
            this.props.send_text(this.props.user.Uin, this.props.contact.UserName, textarea.value);
        }
        textarea.value = "";
    }

    handleSendImage() {
        let file_path = dialog.showOpenDialog({properties: ['openFile']});
        if (!file_path) {
            return;
        }
        this.props.send_image(this.props.user.Uin, this.props.contact.UserName, file_path[0]);
    }

    handleUpdate(e) {
        this.props.update_input(e.target.value);
    }

    render() {
        return (
            <div className="box_ft">
                {true ? <div className="toolbar">
                    <Button icon="picture" size="large" onClick={this.handleSendImage.bind(this)}></Button>
                </div> : null}
                <div className="content">
                    <textarea className="flex" id="text" ref="textarea"
                        onChange={this.handleUpdate.bind(this)}
                        value={this.props.chat_input}>
                </textarea>
                </div>
                <div className="action">
                    <a className="btn" onClick={this.handleSend.bind(this)}>发送</a>
                </div>
            </div>
        )
    }
}

const mapStateToProps = (state: State, ownProps: OwnProps): ConnectedState => ({
    chat_input: state.chat_input
});
const mapDispatchToProps = (dispatch: Redux.Dispatch<State>): ConnectedDispatch => ({
    update_input: (contnet) => dispatch(ChatInputReducer.update(contnet))
})

export default connect(mapStateToProps, mapDispatchToProps)(ChatInput);