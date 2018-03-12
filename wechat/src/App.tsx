import * as React from 'react';
import { Router, Link, Route, IndexRoute } from 'react-router'
import { connect } from 'react-redux';

import Wechat from './Containers/Wechat'
import Layout from './Layout';

class App extends React.Component<any, any> {

    render() {
        return (
            <div>
                <Router history={this.props.history}>
                    <Route path={(window as any).router_root} component={Layout}>
                        <IndexRoute component={Wechat} />
                        <Route path="/wechat" component={Wechat} />
                    </Route>
                </Router>
            </div>
        );
    }
}
export default connect()(App);

