import { combineReducers } from 'redux';
import { routerReducer } from 'react-router-redux'

import wechatReducer, * as Wechat from './Wechat'
import windowReducer, * as Window from './Window'
import chatInputReducer, * as ChatInput from './ChatInput'

export interface State {
    wechat: Wechat.WechatState,
    window: Window.WindowState
    chat_input: ChatInput.ChatInputState,
}

const reducer = combineReducers({
    wechat: wechatReducer,
    routing: routerReducer,
    window: windowReducer,
    chat_input: chatInputReducer
});

export default reducer;
