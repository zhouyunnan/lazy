const path = require('path');
const merge = require('webpack-merge');
const common = require('./webpack.common.js');

const StatsWriterPlugin = require('webpack-stats-plugin').StatsWriterPlugin;
const Visualizer = require('webpack-visualizer-plugin');

const { CleanWebpackPlugin } = require('clean-webpack-plugin');
var MiniCssExtractPlugin = require('mini-css-extract-plugin'); //css提取

module.exports = merge(common, {
    output: {
        publicPath: "./",
        filename: 'js/[name]-[chunkhash].js',
        path: path.resolve(__dirname, '../dist')
    },
    mode: 'production',
    plugins: [
        new CleanWebpackPlugin(),
        // 分离CSS
        new MiniCssExtractPlugin({
            filename: "css/[name][chunkhash].css",
        }),
    ],
    module: {
        rules: [
            {
                test: /\.(scss|css)$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            publicPath: "../"
                        },
                    },
                    'css-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.(png|svg|jpg|gif)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[path][name].[ext]',
                            outputPath: 'img',
                            // publicPath: "./img"   这个不能要，会影响MiniCssExtractPlugin.loader的
                        }
                    }
                ]
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[path][name].[ext]',
                            outputPath: 'fonts/',
                            publicPath: '../../'
                        }
                    }
                ]
            },
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            }

        ]
    },
    devtool: 'source-map',
});