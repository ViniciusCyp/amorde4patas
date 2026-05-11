const path = require('path');
const CopyPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = async (env, argv) => {
  const isProd = argv.mode === 'production';
  const [
    { default: imagemin },
    { default: imageminGifsicle },
    { default: imageminMozjpeg },
    { default: imageminPngquant },
    { default: imageminSvgo }
  ] = await Promise.all([
    import('imagemin'),
    import('imagemin-gifsicle'),
    import('imagemin-mozjpeg'),
    import('imagemin-pngquant'),
    import('imagemin-svgo')
  ]);

  return {
    entry: {
      main: [
        path.resolve(__dirname, 'assets/src/js/main.js'),
        path.resolve(__dirname, 'assets/src/scss/main.scss')
      ]
    },
    output: {
      path: path.resolve(__dirname, 'dist'),
      filename: '[name].js',
      assetModuleFilename: 'media/[name][ext][query]',
      clean: true
    },
    devtool: isProd ? false : 'source-map',
    performance: false,
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: [
                ['@babel/preset-env', {
                  targets: 'defaults'
                }]
              ]
            }
          }
        },
        {
          test: /\.scss$/,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: 'css-loader',
              options: { sourceMap: !isProd, url: false }
            },
            {
              loader: 'postcss-loader',
              options: {
                sourceMap: !isProd,
                postcssOptions: {
                  plugins: [
                    require('postcss-preset-env')({
                      stage: 3
                    })
                  ]
                }
              }
            },
            {
              loader: 'sass-loader',
              options: { sourceMap: !isProd }
            }
          ]
        },
        {
          test: /\.(png|jpe?g|gif|svg|webp|avif|woff2?|ttf|eot)$/i,
          type: 'asset/resource'
        }
      ]
    },
    optimization: {
      minimize: isProd,
      minimizer: [
        new TerserPlugin({
          extractComments: false
        }),
        new CssMinimizerPlugin()
      ]
    },
    plugins: [
      new CopyPlugin({
        patterns: [
          {
            from: path.resolve(__dirname, 'assets/src/images'),
            to: path.resolve(__dirname, 'dist/images'),
            noErrorOnMissing: true,
            async transform(content, absoluteFrom) {
              const sourceBuffer = Buffer.isBuffer(content) ? content : Buffer.from(content);

              if (!isProd) {
                return sourceBuffer;
              }

              if (!/\.(png|jpe?g|gif|svg)$/i.test(absoluteFrom)) {
                return sourceBuffer;
              }

              const optimized = await imagemin.buffer(sourceBuffer, {
                plugins: [
                  imageminGifsicle({ interlaced: true }),
                  imageminMozjpeg({ quality: 75, progressive: true }),
                  imageminPngquant({ quality: [0.65, 0.8] }),
                  imageminSvgo({
                    plugins: [
                      {
                        name: 'preset-default',
                        params: {
                          overrides: {
                            removeViewBox: false
                          }
                        }
                      }
                    ]
                  })
                ]
              });

              return Buffer.from(optimized);
            }
          }
        ]
      }),
      new MiniCssExtractPlugin({
        filename: '[name].css'
      })
    ]
  };
};
