import * as React from 'react';
import { Link } from 'react-router'
import { connect } from 'react-redux';

import { Menu, Icon, Switch } from 'antd';
import { Row, Col } from 'antd';

const SubMenu = Menu.SubMenu;

class Layout extends React.Component<any, any> {

    render() {
        return (
            <div className={'app'}>
                <div className={'menu'}>
                    <Menu style={{ width: 82 }} mode="inline" defaultSelectedKeys={['1']}>
                        <Menu.Item key="1"><Link to="/"><Icon type="message" /></Link></Menu.Item>
                    </Menu>
                </div>
                <div className={'pageContent'}>
                     {this.props.children}
                </div>
            </div>
        );
    }
}
export default connect()(Layout);



