/** @param {import('@roots/bud').Bud} bud */

export default async (bud) => {
    // bud.runtime( false );
    bud.externals( {
      $: 'window.jquery',
      jQuery: 'window.jquery',
      React: 'window.react',
    } );
  
    bud.setPath( '@src', 'assets' );
    bud.setPath( '@dist', 'dist' );

    bud.entry( 'dsr', [
        '@src/scss/main.scss',
        '@src/js/main.js'
    ]);
  
    bud
      .watch([
        'assets/**/*',
      ])
      .proxy('https://dsr.test')
      .serve('http://0.0.0.0:3002');
  }
  